<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Validator;


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
        dd(route('user'));
        $user = User::findOrfail($id);


        // return user as a resource
        return  new UserResource($user);
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
