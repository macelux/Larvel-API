<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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
        $user = User::findOrfail($id);

        // return user as a resource
        return  new UserResource($user);
    }

    public function checkLogin(Request $request)
    {
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])){

            return response()->json([
                'login' => true,
                'username'=> Auth::user()->name
            ],200);

        }
        else{
            return response()->json([
                'data' => 'invalid login details'
            ],500);

        }

    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? $request->password: '12345' ;

        if($user->save()){
            return new UserResource($user);
        }
    }

    public function update(Request $request , $id)
    {
        $user = User::findorfail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            return new UserResource($user);
        }
    }

    public function destroy($id)
    {
        // get user
        $user = User::findOrfail($id);

       if($user->delete()){
        return  new UserResource($user);
       }
    }
}
