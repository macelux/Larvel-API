<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\AuthController;

class UsersController extends Controller
{

    public function index()
    {
        $Users = User::all();
        for($i  = 0 ; $i < count($Users) ; $i++)
        {
            $Users[$i]->count = $i + 1;
        }

        return view('pages.users' , compact('Users'));


    }

    
    
    public function edit($id)
    { 
        $User = User::findorfail($id);
      

      
        return view('admin.users.edit', compact('User'));
    }

    public function update(UpdateUserRequest $request)
    {
      
      $params = $request->except('_token' , 'password' , 'email');
      $User = User::findorfail($request->user_id);
      $User->update($params);
      if($request->password == "")
          $User->save();
      else
          $User->password  = Hash::make($request->password);
        $User->save();

        if($request->email== "")
            $User->save();
        else if($User->email == $request->email)
            $User->save();
        else
            $User->email = $request->email;
        $User->save();
        session()->flash("message" , "User added Sucessfully");
        return redirect()->route('users.index');
     
    }
    public function destroy($id)
    {
        
        $User = User::findorfail($id);
//        (new AuthController())->logout();
//        if(auth('api')->logout())
//            return "true";


//        return "cool";
//        $token =  auth()->tokenById($id);
//        return $token;
        $User->delete();
        session()->flash("message" , "User deleted Sucessfully");



        return redirect()->route('users.index');
    }
}


