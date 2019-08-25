<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    
    /* public function __construct()
    {
      // PLEASE ADD the jwt.auth middleware to protect your resouce
        $this->middleware('jwt.auth');
    } */
    public function login(Request $request) {

        // $validator = Validator::make($request->all());
        $checkValidation = $this->checkValidation($request->all());
        if ($checkValidation == true) {
            // get email and password from request
            $credentials = request(['email', 'password']);
            
            // try to auth and get the token using api authentication
            if (!$token = auth('api')->attempt($credentials)) {
                // if the credentials are wrong we send an unauthorized error in json format
                $response = [
                'status' => 401,
                'error'  => true,
                'result' => false ,
                'message' => 'Wrong Email/Password',
                'data'=> []
            ];
            return response()->json($response,401);
            }
        }
        $successRes = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'type'    => 'bearer', // you can ommit this
            'token'   => $token,
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration    
        ];
        return response()->json($successRes,200);
    }

    public function checkValidation(array $request)
    {
        $validator = Validator::make($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $response = [
                'status' => 403,
                'error'  => true,
                'result' => false ,
                'message' => $messages,
                'data'=> []
            ];
            return response()->json($response,403);
        }
        return true;
    }

    public function user(Request $request)
    {
        return $request->all();
        return auth('api')->user();
    }
}
