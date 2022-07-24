<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        if( Auth::attempt($request->only('email', 'password')) ){
            $token = auth()->user()->createToken('auth_token');

            return response()->json([
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer'
            ],200);
        }else{
            return response()->json([
                'message' => 'Credenciales inválidas'
            ],401);
        }
    }
}
