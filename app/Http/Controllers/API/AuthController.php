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
            'password'=>'required'
        ]) ;
        if($validator -> fails())
        {
            return response(['errors' , $validator->errors()->all()]  , 422);
        }


        $user =    User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
//
        ]);
        $accesstoken = $user->createToken('authToken')->accessToken;


        return response(['user' => $user , 'accesstoken ' , $accesstoken]);
    }
    public function login(Request $request)
    {


        $validator= Validator::make($request->all(),[
            'email'=>'email|required',
            'password'=>'required'
        ]);
        if($validator -> fails())
        {
            return response(['errors' => $validator->errors() -> all()]  ,422);
        }
        $user = User::where('email' , $request->email) ->first();
        if($user)
        {
            if(Hash::check($request->password , $user->password))
            {

                $accesstoken = $user->createToken('authToken')->accessToken;
                return response(['user' =>$user , 'access_token' => $accesstoken]);

            }
            else
            {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        }
        else
        {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }


    }
}
