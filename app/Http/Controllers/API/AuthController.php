<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',

        ]) ;
        if($validator -> fails())
        {
            return response(['errors' , $validator->errors()->all()]  , 400);
        }


        $user =    User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

//
        ]);
        // $token = JWTAuth::fromUser($user);
        // // $user->api_token= $token;
        // // $user->save();

        // return response->json(compact('user' , 'token'),201);
         return response()->json(['data' => $user], 201);
    }
    public function login(Request $request)
    {
        $credientials = $request -> only('email' , 'password');
        $validator = Validator::make($credientials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        // try
        // {
            if(!$token=JWTAuth::attempt($credientials))
            {
                return response(['error' => 'invalid_credentials'],400);
            }
        // }

        // catch(JWTException $e)
        // {
        //     return response()->json(['error' => 'could_not_create_token'], 500);
        // }
        return response()->json(compact('token'));
        
       
        

       


    }
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
}
