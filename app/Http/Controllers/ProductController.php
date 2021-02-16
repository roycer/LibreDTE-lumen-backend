<?php namespace App\Http\Controllers;

use App\Caratula;
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

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fconfig;

    public function __construct()
    {}

    public function todo(){
        $products = Product::select('products.id','products.name','products.description',
                    'products.measure_unit','products.quantity','products.price_unit','products.type_line'
                    ,'products.total_line','enterprises.bussiness_name as id_enterprises')
                    ->join('enterprises','enterprises.id','=','products.id_enterprises')->get();
        
        return response()->json(['status' => 'success','result' => $products]);
    }


    public function all(Request $request){
        $products = Product::all()->toArray();
        return response()->json(['status' => 'success','result' => $products]);
    }

    public function add(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'measure_unit' => 'required',
            'quantity' => 'required',
            'price_unit' => 'required',
            'type_line' => 'required',
            'total_line' => 'required',
            'id_enterprises' => 'required',
        ]);
        
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->measure_unit = $request->measure_unit;
        $product->quantity = $request->quantity;
        $product->price_unit = $request->price_unit;
        $product->type_line = $request->type_line;
        $product->total_line = $request->total_line;
        $product->id_enterprises = $request->id_enterprises;

        if($product->save()){
            return response()->json(['status' => true, 'result' => 'Producto creado']);
        }

        return response()->json(['status' => false, 'result' => null]);

    }

    public function get($id){
        $products = Product::where('id_enterprises',$id)->get()->toArray();
        return response()->json(['status' => 'success','result' => $products]);
    }

    public function put(Request $request,$id){
        $product = Product::find($id);

        if($product){

            if($request->has('name') && $request->rut != ""){
                $product->name = $request->name;
            }

            if($request->has('description') && $request->description != ""){
                $product->description = $request->description;
            }

            if($request->has('measure_unit') && $request->measure_unit != ""){
                $product->measure_unit = $request->measure_unit;
            }

            if($request->has('quantity') && $request->quantity != ""){
                $product->quantity = $request->quantity;
            }

            if($request->has('price_unit') && $request->price_unit != ""){
                $product->price_unit = $request->price_unit;
            }

            if($request->has('type_line') && $request->type_line != ""){
                $product->type_line = $request->type_line;
            }

            if($request->has('total_line') && $request->total_line != ""){
                $product->total_line = $request->total_line;
            }

            if($request->has('enterprises') && $request->id_enterprises != ""){
                $product->id_enterprises = $request->id_enterprises;
            }

            if($product->save()){
                return response()->json(['status' => true, 'result' => 'Producto actualizado']);
            }

        }
 
        return response()->json(['status' => false, 'result' => null]);
    }

    public function remove($id){

        if(Product::destroy($id)){

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
