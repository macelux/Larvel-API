<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;




class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
            // echo $request->email;
            if(auth()->user()->role_id == 2 or 3)
                return $next($request);
            else
                return response(["message" => "unauthorized"]);

            
    }
}
