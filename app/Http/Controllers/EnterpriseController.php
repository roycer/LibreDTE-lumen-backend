<?php namespace App\Http\Controllers;

use App\Caratula;
use App\ControlVehicle;
use App\Detalle;
use App\Documento;
use App\Emisor;
use App\Enterprise;
use App\Insumo;
use App\Produccion;
use App\Product;
use App\Receptor;
use App\Receta;
use App\Record;
use App\Referencia;
use sasco\LibreDTE\Sii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnterpriseController extends Controller
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
        $enterprises = Enterprise::all()->toArray();
        return response()->json(['status' => 'success','result' => $enterprises]);
    }

    public function add(Request $request){

        $this->validate($request, [
            'rut' => 'required',
            'bussiness_name' => 'required',
            'bussiness' => 'required',
            'bussiness_code' => 'required',
            'address' => 'required',
            'commune' => 'required',
            'city' => 'required',
        ]);

        $count = Enterprise::where('rut',$request->rut)->count();
        
        if($count>0) {
            return response()->json(['status' => false, 'result' => null]);
        }

        $enterprise = new Enterprise();

        $enterprise->rut = $request->rut;
        $enterprise->bussiness_name = $request->bussiness_name;
        $enterprise->bussiness = $request->bussiness;
        $enterprise->bussiness_code = $request->bussiness_code;
        $enterprise->address = $request->address;
        $enterprise->commune = $request->commune;
        $enterprise->city = $request->city;

        if($enterprise->save()){
            return response()->json(['status' => true, 'result' => 'Empresa creada']);
        }

        return response()->json(['status' => false, 'result' => null]);

    }

    public function get($id){
        $enterprise = Enterprise::find($id);
        if($enterprise != null){
            return response()->json(['status' => true, 'result' => $enterprise]);
        }

        return response()->json(['status' => false, 'result' => null]);
    }

    public function put(Request $request, $id){

        $enterprise = Enterprise::find($id);

        if($enterprise){

            if($request->has('rut') && $request->rut != ""){
                $enterprise->rut = $request->rut;
            }

            if($request->has('bussiness_name') && $request->bussiness_name != ""){
                $enterprise->bussiness_name = $request->bussiness_name;
            }

            if($request->has('bussiness') && $request->bussiness != ""){
                $enterprise->bussiness = $request->bussiness;
            }

            if($request->has('bussiness_code') && $request->bussiness_code != ""){
                $enterprise->bussiness_code = $request->bussiness_code;
            }

            if($request->has('address') && $request->address != ""){
                $enterprise->address = $request->address;
            }

            if($request->has('commune') && $request->commune != ""){
                $enterprise->commune = $request->commune;
            }

            if($request->has('city') && $request->city != ""){
                $enterprise->city = $request->city;
            }

            if($enterprise->save()){
                return response()->json(['status' => true, 'result' => 'Empresa actualizada']);
            }

        }
 
        return response()->json(['status' => false, 'result' => null]);

    }

    public function remove($id){

        if(Enterprise::destroy($id)){

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
