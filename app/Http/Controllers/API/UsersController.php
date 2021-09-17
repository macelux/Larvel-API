<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Notifications\UserDeleted;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function show($id)
    {

        $user = User::findorfail($id);


        if(auth()->user()->id == $id)
            return  new UserResource($user);
        else
            return response(['message' => 'you can only view your own info'] , 401);

    }


    public function update(Request $request , $id)
    {
        $user = User::findorfail($id);
        $request->validate([
            'first_name' => [ 'string', 'max:255'],
            'last_name' => [ 'string', 'max:255'],
            'email' =>  ['email' , Rule::unique('users')->ignore($user)]

        ]);
        if(auth()->user()->id  == $id)
        {
            $params = $request->except('_token');
//            dd($params);
//            return $params;
            $user->update($params);
            $user->save();

            return  new UserResource($user);
        }
        else
        {
            return response(['message' => 'you can only modify your own info'] , 401);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);

        if(auth()->user()->id  == $id)
        {
            if($user->delete()){
                Notification::send(Admin::all() ,new UserDeleted($user));
                return  new UserResource($user);
            }
        }
        else
        {
            return response(['message' => 'you can only delete your own info'] , 401);
        }
    }
}
