<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate();
        //return UserResource::collection($user);
        return response()->json($customers);
    }

    public function show($id)
    {
        // get user
        $user = Customer::findOrfail($id);

        // return user as a resource
        return  new UserResource($user);
    } 

    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            return new UserResource($user);
        }
    }

    public function update(Request $request)
    {
        $user = User::findorfail($request->id);

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
