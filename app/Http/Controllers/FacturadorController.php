<?php namespace App\Http\Controllers;

use App\Customer;
use App\Enterprise;
use App\Product;
use App\Receiver;
use App\Record;
use sasco\LibreDTE\Sii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fconfig;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->fconfig = ['file'=>resource_path('CertificadoFrenon2020.pfx'), 'pass'=>'Frenon2020'];
        \sasco\LibreDTE\Sii::setServidor('maullin');
        \sasco\LibreDTE\Sii::setAmbiente(\sasco\LibreDTE\Sii::CERTIFICACION);
        date_default_timezone_set('America/Santiago');
    }

    public function dte(Request $request){

        $Firma = new \sasco\LibreDTE\FirmaElectronica($this->fconfig);

        $this->validate($request, [

            'cab_tipo_dte' => 'required',
            'cab_rut_emisor' => 'required',
            'cab_razon_social' => 'required',
            'cab_giro' => 'required',
            'cab_acteco' => 'required',
            'cab_direccion' => 'required',
            'cab_comuna' => 'required',
            'cab_ciudad' => 'required',
            'cab_fecha_emision' => 'required',
            'cab_forma_pago' => 'required',
            //receptor
            'rec_documento' => 'required',
            'rec_ciudad' => 'required',
            'rec_comuna' => 'required',
            'rec_dirección' => 'required',
            'rec_giro' => 'required',
            'rec_razon_social' => 'required',
            //details
            'details' => 'required',
//            'details.*.det_tipo_linea' => 'required',
            'details.*.det_nombre_item' => 'required',
//            'details.*.det_glosa' => 'required',
            'details.*.det_cantidad' => 'required',
            'details.*.det_precio_unitario' => 'required',

        ]);

        $TipoDte = $request->cab_tipo_dte;

        $Emisor = $this->getEmisor(
            $request->cab_rut_emisor,
            $request->cab_razon_social,
            $request->cab_giro,
            $request->cab_acteco,
            $request->cab_direccion,
            $request->cab_comuna,
            $request->cab_ciudad
        );

        $folio = $this->getFolio($Emisor['id'],$TipoDte);

        $folios = [
            $TipoDte => $folio,
        ];

        $Receptor = $this->getReceptor(
            $Emisor['id'],
            $request->rec_documento,
            $request->rec_razon_social,
            $request->rec_giro,
            $request->rec_dirección,
            $request->rec_comuna,
            $request->rec_ciudad

        );

        $detalles = $this->getDetalles($Emisor['id'], $request->details);

        $caratula = $this->getCaratula(
            '16636576-7',
            '60803000-K',
            '2020-09-04',
            0
        );

        $referencias = null;

        $FmaPago = null;

        if($request->has('references') && $request->references != ""){
            $referencias = $this->getReferencias($request->references);
        }

        if($request->has('cab_forma_pago') && $request->cab_forma_pago != ""){
            $FmaPago = $request->cab_forma_pago;
        }

        $set_dtes = [
            [
                'Encabezado' => [
                    'IdDoc' => [
                        'TipoDTE' => $TipoDte,
                        'Folio' => $folios[$TipoDte],
                    ],
                    'Emisor' => $Emisor['sii'],
                    'Receptor' => $Receptor['sii'],
                ],
                'Detalle' => $detalles['details'],
            ],
        ];

        if($detalles['mnf'] > 0){
            $set_dtes[0]['Encabezado']['Totales']['MontoNF'] = $detalles['mnf'];
        }

        if($referencias){
            $set_dtes[0]['Referencia'] =  $referencias;
        }

        if($FmaPago){
            $set_dtes[0]['Encabezado']['IdDoc']['FmaPago'] =  $FmaPago;
        }

        $Folios = [];

        foreach ($folios as $tipo => $cantidad){
            $Folios[$tipo] = new Sii\Folios(file_get_contents(resource_path('FoliosSII_'.$tipo.'.xml')));
        }

        //Timbramos y Firmamos cada documento DTE
        $EnvioDTE = new Sii\EnvioDte();

        foreach ($set_dtes as $documento) {

            $DTE = new Sii\Dte($documento);

            if (!$DTE->timbrar($Folios[$DTE->getTipo()]))
                break;
            if (!$DTE->firmar($Firma))
                break;

            $EnvioDTE->agregar($DTE);

        }

        $EnvioDTE->setCaratula($caratula['sii']);
        $EnvioDTE->setFirma($Firma);
        $xml  = $EnvioDTE->generar();

        $path_filename = resource_path('dinamic/envio_dte_'.date('Y_m_d_H_i_s').'.xml');
        touch($path_filename);
        file_put_contents($path_filename, $xml);  // guardar XML en sistema de archivos

        if($track_id = $EnvioDTE->enviar()){
            
            if($this->saveDte($track_id,$TipoDte,$folio,$Emisor['id'],$xml)){

                return response()->json(['status' => true, 'result' => $track_id, 'xml' =>  $xml]);
            }

            return response()->json(['status' => false, 'result' => $track_id, 'xml' =>  $xml]);

        }

        $errors = [];

        foreach (\sasco\LibreDTE\Log::readAll() as $error)
        {
            array_push($errors,$error);
            Log::info($error);
        }

        return response()->json(['status' => false, 'result' => $errors]);
    }
    
    public function estado(Request $request){

        $this->validate($request, [
            'trackid' => 'required',
        ]);

        $token = Sii\Autenticacion::getToken($this->fconfig);

        if($token){
            $estado = \sasco\LibreDTE\Sii::request('QueryEstUp', 'getEstUp', ['77180742', '9', $request->trackid, $token]);
            if ($estado!==false) {
                $estado->saveXML(resource_path('dinamic/estado_dte.xml'));
                return $estado->xpath('/SII:RESPUESTA/SII:RESP_HDR');
            }
        }

    }

    private function getCaratula($RutEnvia,$RutReceptor,$FchResol,$NroResol){

        return [
            'id' => '',
            'sii' => [
                'RutEnvia' => $RutEnvia,
                'RutReceptor' => $RutReceptor,
                'FchResol' => $FchResol,
                'NroResol' => $NroResol
            ]
        ];

    }

    private function getReferencias($referencias){

        $references = [];

        foreach ($referencias as $referencia){

            if($referencia['ref_folio'] != "" && $referencia['ref_razon']!= "" && $referencia['ref_tipo_dte'] != "" && $referencia['ref_fecha_emision'] != ""){
                array_push($references,
                    [
                        'CodRef' => $referencia['ref_codigo'],
                        'FchRef' => $referencia['ref_fecha_emision'],
                        'FolioRef' => $referencia['ref_folio'],
                        'RazonRef' => $referencia['ref_razon'],
                        'TpoDocRef' => $referencia['ref_tipo_dte']
                    ]
                );
            }
        }

        if(count($references)){
            return $references;
        }

        return null;
    }

    private function getEmisor($RUTEmisor,$RznSoc,$GiroEmis,$Acteco,$DirOrigen,$CmnaOrigen,$CiudadOrigen){

        $enterprise = Enterprise::where('rut',$RUTEmisor)->get()->first();

        if($enterprise){
            return [
                'id' => $enterprise->id,
                'sii' => [
                    'RUTEmisor' => $enterprise->rut,
                    'RznSoc' => $enterprise->bussiness_name,
                    'GiroEmis' => $enterprise->bussiness,
                    'Acteco' => $enterprise->bussiness_code,
                    'DirOrigen' => $enterprise->address,
                    'CmnaOrigen' => $enterprise->commune,
                    'CiudadOrigen' => $enterprise->city
                ]
            ];
        }

        $enterprise = new Enterprise();
        $enterprise->rut = $RUTEmisor;
        $enterprise->bussiness_name = $RznSoc;
        $enterprise->bussiness = $GiroEmis;
        $enterprise->bussiness_code = $Acteco;
        $enterprise->address = $DirOrigen;
        $enterprise->commune = $CmnaOrigen;
        $enterprise->city = $CiudadOrigen;

        if($enterprise->save()){

            return [
                'id' => $enterprise->id,
                'sii' => [
                    'RUTEmisor' => $enterprise->rut,
                    'RznSoc' => $enterprise->bussiness_name,
                    'GiroEmis' => $enterprise->bussiness,
                    'Acteco' => $enterprise->bussiness_code,
                    'DirOrigen' => $enterprise->address,
                    'CmnaOrigen' => $enterprise->commune,
                    'CiudadOrigen' => $enterprise->city
                ]
            ];

        }

    }

    private function getReceptor($emisor_id, $RUTRecep,$RznSocRecep,$GiroRecep,$DirRecep,$CmnaRecep,$CiudadRecep){

        $customer = Receiver::where('rut',$RUTRecep)->where('id_enterprises',$emisor_id)->get()->first();

        if($customer){
            return [
                'id' => $customer->id,
                'sii' => [
                    'RUTRecep' => $customer->rut,
                    'RznSocRecep' => $customer->bussiness_name,
                    'GiroRecep' => $customer->bussiness,
                    'DirRecep' => $customer->address,
                    'CmnaRecep' => $customer->commune,
                    'CiudadRecep' => $customer->city
                ]
            ];
        }

        $customer = new Receiver();
        $customer->rut = $RUTRecep;
        $customer->bussiness_name = $RznSocRecep;
        $customer->bussiness = $GiroRecep;
        $customer->address = $DirRecep;
        $customer->commune = $CmnaRecep;
        $customer->city = $CiudadRecep;
        $customer->id_enterprises = $emisor_id;

        if($customer->save()){

            return [
                'id' => $customer->id,
                'sii' => [
                    'RUTRecep' => $customer->rut,
                    'RznSocRecep' => $customer->bussiness_name,
                    'GiroRecep' => $customer->bussiness,
                    'DirRecep' => $customer->address,
                    'CmnaRecep' => $customer->commune,
                    'CiudadRecep' => $customer->city
                ]
            ];

        }

    }

    private function getDetalles($emisor_id, $detalles){

        $details = [];
        $monto_no_facturable = 0;

        foreach ($detalles as $detalle){

            $product = Product::where('name',$detalle['det_nombre_item'])->get()->first();

            if(!$product){
                $product = new Product();
                $product->name = $detalle['det_nombre_item'];
                $product->price_unit = $detalle['det_precio_unitario'];
                $product->type_line = $detalle['det_tipo_linea'];
                $product->id_enterprises = $emisor_id;
                $product->save();
            }else{
                $product->type_line = $detalle['det_tipo_linea'];
                $product->price_unit = $detalle['det_precio_unitario'];
                $product->save();
            }

            if( $detalle['det_tipo_linea'] == "1" or $detalle['det_tipo_linea'] == "2" ){

                if( $detalle['det_tipo_linea'] == "2"){
                    $monto_no_facturable += ($detalle['det_precio_unitario']*$detalle['det_cantidad']);
                }


                array_push($details,
                    [
                        'NmbItem' => $detalle['det_nombre_item'],
                        'QtyItem' => $detalle['det_cantidad'],
                        'PrcItem' => $detalle['det_precio_unitario'],
                        'IndExe' => $detalle['det_tipo_linea'],
                    ]
                );

            }
            else{

                array_push($details,
                    [
                        'NmbItem' => $detalle['det_nombre_item'],
                        'QtyItem' => $detalle['det_cantidad'],
                        'PrcItem' => $detalle['det_precio_unitario'],
                    ]
                );

            }


        }

        return ['details'=> $details , 'mnf' => $monto_no_facturable];
    }

    private function saveDte($track_id=null,$TipoDte,$folio,$emisor_id,$xml){

        $record = new Record();
        $record->type_dte = $TipoDte;
        $record->tracking = $track_id;
        $record->number = $folio;
        $record->xml = base64_encode($xml);
        $record->id_enterprises = $emisor_id;

        if($record->save())
            return true;

        return false;

    }

    private function getFolio($emisor_id, $typeDte){

        $dtefolio = Record::where('id_enterprises',$emisor_id)->where('type_dte',$typeDte)->get()->last();

        if($dtefolio)
            return $dtefolio->number + 1;

        return 60;

    }

}
