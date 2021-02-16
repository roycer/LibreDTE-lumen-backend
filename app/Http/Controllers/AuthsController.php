<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;;
use Log;

class AuthsController extends Controller {

    public function __construct()
    {
    }

    public function authenticate(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['status' => 'fail', 'error'=>'invalid_credentials'], 401);
            }
            return response()->json(['status' => 'success','token' => $token]);
        } catch (JWTException $e) {
            return response()->json(['status' => 'fail'], 500);
        }
    }

    public function valid(Request $request){
        if($request->user()) {
            Log::info($request->user());
            return response()->json(['status' => 'success'], 200);
        }
        else
            return response()->json(['status' => 'Unauthorized'],401);
    }

}
