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
        event(new Registered($admin));
        session()->flash("message" , "Admin added Sucessfully");
        return redirect()->route('verification.notice');

    }
    public function index()
    {
//        dd(auth::guard('admin')->user()->is_super);
        $Admins = Admin::all();
        for($i  = 0 ; $i < count($Admins) ; $i++)
        {
            $Admins[$i]->count = $i + 1;
        }

        return view('pages.admin' , compact('Admins'));


    }
//
//
//
    public function editprofile()
    {
        $Admin = Auth::guard('admin')->user();
        return view('admin.admin.edit', compact('Admin'));
    }

    public function edit($id)
    {


        $Admin = Admin::findorfail($id);



        return view('admin.admin.edit', compact('Admin'));
    }
//
    public function update(UpdateAdminRequest $request)
    {

        $params = $request->except('_token');
        $Admin =Admin::findorfail($request->admin_id);
        $Admin->update($params);
        session()->flash("message" , "Admin updated Sucessfully");
        if(Gate::allows('is_super_admin'))
            return redirect()->route('admins.index');
        else
            return redirect()->route('admin.dashboard');
    }
    public function destroy($id)
    {

        $Admin = Admin::findorfail($id);
        $Admin->delete();
        session()->flash("message" , "Admin deleted Sucessfully");
        return redirect()->route('admins.index');
    }

}
