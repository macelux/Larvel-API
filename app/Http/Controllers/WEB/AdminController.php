<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{

    public function create()
    {
        return view('admin.admin.create');
    }


    public function store(StoreAdminRequest $request)
    {

        $params = $request->except('_token', 'password');

        $admin = Admin::create($params);
        $admin->password = Hash::make($request->password);
        $admin->save();
        session()->flash("message" , "Admin registered Sucessfully , Email verifcation needed to activate account");
        event(new Registered($admin));

        return redirect()->route('admins.index');


    }
    public function index()
    {

        $Admins = Admin::all();
        for($i  = 0 ; $i < count($Admins) ; $i++)
        {
            $Admins[$i]->count = $i + 1;
        }

        return view('pages.admin' , compact('Admins'));


    }

    public function editprofile()
    {
        $Admin = Auth::guard('admin')->user();
        session()->put('url.intended' , URL::current());
        return view('admin.admin.edit', compact('Admin'));
    }

    public function edit($id)
    {


        $Admin = Admin::findorfail($id);
        session()->put('url.intended' , URL::previous());
        return view('admin.admin.edit', compact('Admin'));
    }

    public function update(Request $request)
    {

        $params = $request->except('_token');
        $Admin =Admin::findorfail($request->admin_id);
        $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' =>  ['email' , Rule::unique('users')->ignore($Admin)],

        ]);

        $Admin->update($params);
        session()->flash("message" , "Admin updated Sucessfully");
        return Redirect::intended('/');

    }
    public function destroy($id)
    {

        $Admin = Admin::findorfail($id);
        $Admin->delete();
        session()->flash("message" , "Admin deleted Sucessfully");
        return redirect()->route('admins.index');
    }

}
