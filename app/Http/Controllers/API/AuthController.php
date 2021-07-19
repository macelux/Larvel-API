<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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

        $user->api_token= $user->createToken('authToken')->accessToken;
        $user ->save();

        return response(['user' => $user , 'accesstoken ' , $user->api_token]);
    }
    public function login(Request $request)
    {


        $validator= Validator::make($request->all(),[
            'email'=>'email|required',
            'password'=>'required'
        ]);
        if($validator -> fails())
        {
            return response(['errors' => $validator->errors() -> all()]  ,400);
        }
        $user = User::where('email' , $request->email) ->first();
        if($user)
        {
            if(Hash::check($request->password , $user->password))
            {

                $user->api_token= $user->createToken('authToken')->accessToken;
                $user->save();
                return response(['user'=>$user , 'access_token' => $user->api_token]);

            }
            else
            {
                $response = ["message" => "Password mismatch"];
                return response($response, 400);
            }
        }
        else
        {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }


    }
}
