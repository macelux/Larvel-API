<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function update(Request $request)
    {

      $params = $request->except('_token' , 'password' , 'email');
      $User = User::findorfail($request->user_id);

        $request->validate([
            'first_name' => [ 'string', 'max:255'],
            'last_name' => [ 'string', 'max:255'],

            'email' =>  ['email' , Rule::unique('users')->ignore($User)]

        ]);
      $User->update($params);
      $User->save();
        session()->flash("message" , "User updated Sucessfully");
        return redirect()->route('users.index');
     
    }
    public function destroy($id)
    {
        
        $User = User::findorfail($id);
        $User->delete();
        session()->flash("message" , "User deleted Sucessfully");



        return redirect()->route('users.index');
    }
}


