<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $userInfo = User::first();
        $token    = JWTAuth::fromUser($userInfo);
        $response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'message' => 'LogedIn user informaton.',
            'token'   => $token,
            'data'    => $userInfo,
        ];
        return Response::json($response,200);
    }
}
