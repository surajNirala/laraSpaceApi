<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index($value='')
    {
    	$userInfo = auth('api')->user();
    	$response = [
            'status'  => 200,
            'error'   => false,
            'result'  => true ,
            'message' => 'LogedIn user informaton.',
            'data'    => $userInfo
        ];
        return response()->json($response,200);
    }
}
