<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
// use Auth;

class UsersController extends Controller

{

    public function index()
    {
        $user = User::paginate(5);
        return UserResource::collection($user);
        //return response()->json($user);
    }

    public function show($id)
    {
        // get user
       if(auth()->user()->id == $id)
            return  new UserResource($user);
        else
            return response(['message' => 'you can only view your own info'] , 401);
    }

    

    

    public function update(Request $request , $id)
    {
        $user = User::findorfail($id);

        if(auth()->user()->id  == $id)
        {
            $validator = Validator::make($request->all() ,[
                    'name'=>'required',
                    'email'=>'required|email|unique:users',

                ]);
            if($validator -> fails())
            {
                return response(['errors' , $validator->errors()->all()]  , 400);
            }
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

        }
        else
        {
            return response(['message' => 'you can only modify your own info'] , 401);
        }
    }

    public function destroy($id)
    {
        // get user
        $user = User::findOrfail($id);

       if(auth()->user()->id  == $id)
        {
            if($user->delete()){
                return  new UserResource($user);
            }
        }
        else
        {
          return response(['message' => 'you can only delete your own info'] , 401);
        }
    }
}
