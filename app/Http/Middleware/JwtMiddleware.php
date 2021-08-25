<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
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
//        $user = JWTAuth::parseToken()->authenticate();
         try 
        {
            $user = JWTAuth::parseToken()->authenticate();

        }

        catch (Exception $e) 
        {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['status' => 'Token is Invalid']);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['status' => 'Token is Expired']);
            }
            else
            {
//                if($user->id == "")
//                    return responses(["message" => "the token is expired becuase user has been deleted"]);
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}
