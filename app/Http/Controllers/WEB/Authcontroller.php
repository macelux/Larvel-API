<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LoginRequest;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Auth;



class Authcontroller extends Controller
{




    public function login(LoginRequest $request)
    {

        if(Auth::guard('admin')->attempt($request->only('email' , 'password') , $request->remember))
        {


            return redirect()->route('home');
        }

            return back()->with('status' , 'Invalid login details');

    }


    
    

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('login');


    }
}
