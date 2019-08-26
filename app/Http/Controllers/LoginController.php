<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
// use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    
    /* public function __construct()
    {
      // PLEASE ADD the jwt.auth middleware to protect your resouce
        $this->middleware('jwt.auth');
    } */
   /* public function login(Request $request) {

        $checkValidation = $this->checkValidation($request->all());
        if ($checkValidation == true) {
            $credentials = request(['email', 'password']);
            if (!$token = auth('api')->attempt($credentials)) {
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
    }*/

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $response = [
                    'status' => 401,
                    'error'  => true,
                    'result' => false ,
                    'message' => 'Wrong Email/Password',
                    'data'=> []
                ];
                return response()->json($response,401);
                // return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'type'    => 'bearer', // you can ommit this
            'token'   => $token,
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration    
        ];
        return response()->json($response,200);
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

    public function logout(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
