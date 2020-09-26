<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        
        if(!auth()->attempt($data)) {
            
            return response()->json(['message'=>'invalid credentials'],422);
        }

        $accessToken= auth()->user()->createToken('authToken')->accessToken;

        return response(['user'=>auth()->user(),'access_token'=>$accessToken]);

    }

    public function register(Request $request){
        
        $validatedData=$request->validate([
            'name'=>'required|unique:users',
            'email'=>'email|required|unique:users',
            'password'=>'required'
        ]);

        $validatedData['password']=bcrypt($request->password);

        $user = User::create($validatedData);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=>$user,'access_token'=>$accessToken]);
    }

    public function logout(Request $request){
        
        $request->user()->token()->revoke();
        return response(['message'=>'sucessfully logged out']);
    }
}
