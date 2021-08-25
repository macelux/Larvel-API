<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
//use Illuminate\Support\Facades\Auth
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;



class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->headers->set('Accept' , 'application/json');
        $params = $request->except('_token' , 'password');
        $user   = User::create($params);
        $user->password = Hash::make($request->password);
        $user->save();
//        event(new Registered($user));
////        $user->sendEmailVerificationNotification();
//        return response(["message" => "check your email for a verification link in order to activate your account"]);
        return new UserResource($user);
    }
    public function login(LoginRequest $request)
    {
        $credientials = $request->only('email' , 'password');
        if(!$token=JWTAuth::attempt($credientials))
        {
            return response(['error' => 'invalid_credentials'],400);
        }


        $user = User::where('email',$request->email)->first();

        return response([ 'token' => compact('token')]);
    }
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->token);
        return response()->json(['status' => 'success','message' => 'logout'], 201);

    }
}
