<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class sadminLogin
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
        if(!$request->email)
            return response(['error' => 'email is required']);
        $user = User::where('email',$request->email)->first();
        if(!$user)
            return response(['error' => 'email is wrong']);

        $user = User::where('email',$request->email)->first();
        if($user -> role_id == 3)
        {
            return $next($request);
        }
        else
            return response(['message' => 'unauthorized']);
        return $next($request);
    }
}
