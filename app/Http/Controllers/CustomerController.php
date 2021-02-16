<?php namespace App\Http\Controllers;

use App\Caratula;
use App\Customer;
use App\Detalle;
use App\Documento;
use App\Emisor;
use App\Enterprise;
use App\Insumo;
use App\Produccion;
use App\Product;
use App\Receiver;
use App\Receptor;
use App\Receta;
use App\Record;
use App\Referencia;
use sasco\LibreDTE\Sii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fconfig;

    public function __construct()
    {}

    public function all(Request $request){
        $customer = Receiver::all()->toArray();
        return response()->json(['status' => 'success','result' => $customer]);

    }

    public function todo(){
        $customers = Receiver::select('receivers.id','receivers.document','receivers.bussiness_name',
                    'receivers.bussiness','receivers.address','receivers.commune','receivers.city'
                    ,'receivers.ppassport','enterprises.bussiness_name as id_enterprises')
                    ->join('enterprises','enterprises.id','=','receivers.id_enterprises')->get();
        
        foreach($customers as $cus){
            if($cus['ppassport'] == 1 || $cus['ppassport'] == true)
                $cus['ppassport'] = 'Extrangero';
            else
            $cus['ppassport'] = 'Nacional';
        }
        return response()->json(['status' => 'success','result' => $customers]);
    }

    public function get($id){
        $customers = Receiver::where('id_enterprises',$id)->get()->toArray();
        return response()->json(['status' => 'success','result' => $customers]);
    }

    public function getData(Request $request){

        $this->validate($request, [

            'id_enterprise' => 'required',
            'document' => 'required',
        ]);

        $customer = Receiver::where('id_enterprises',$request->id_enterprise)->where('rut',$request->rut)->get()->first();

        return response()->json(['status' => 'success','result' => $customer]);
    }

    public function add(Request $request){

        $this->validate($request, [
            'document' => 'required',
            'bussiness_name' => 'required',
            'bussiness' => 'required',
            'address' => 'required',
            'commune' => 'required',
            'city' => 'required',
            'ppassport' => 'required',
            'id_enterprises' => 'required',
        ]);
        
        $customer = new Receiver();

        $customer->document = $request->document;
        $customer->bussiness_name = $request->bussiness_name;
        $customer->bussiness = $request->bussiness;
        $customer->address = $request->address;
        $customer->commune = $request->commune;
        $customer->city = $request->city;
        $customer->ppassport = $request->ppassport;
        $customer->id_enterprises = $request->id_enterprises;

        if($customer->save()){
            return response()->json(['status' => true, 'result' => 'Cliente creado']);
        }

        return response()->json(['status' => false, 'result' => null]);

    }


    public function put(Request $request,$id){
        $customer = Receiver::find($id);

        if($customer){

            if($request->has('document') && $request->document != ""){
                $customer->document = $request->document;
            }

            if($request->has('bussiness_name') && $request->bussiness_name != ""){
                $customer->bussiness_name = $request->bussiness_name;
            }

            if($request->has('bussiness') && $request->bussiness != ""){
                $customer->bussiness = $request->bussiness;
            }

            if($request->has('address') && $request->address != ""){
                $customer->address = $request->address;
            }

            if($request->has('commune') && $request->commune != ""){
                $customer->commune = $request->commune;
            }

            if($request->has('city') && $request->city != ""){
                $customer->city = $request->city;
            }

            if($request->has('ppassport') && $request->ppassport != ""){
                $customer->ppassport = $request->ppassport;
            }

            if($request->has('id_enterprises') && $request->id_enterprises != ""){
                $customer->id_enterprises = $request->id_enterprises;
            }

            if($customer->save()){
                return response()->json(['status' => true, 'result' => 'Cliente actualizado']);
            }
        }
 
        return response()->json(['status' => false, 'result' => null]);
    }

    public function remove($id){
        if(Receiver::destroy($id)){
            return response()->json([
                'status' => 'success',
                'result' => null
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'result' => null
        ]);
    }
}
