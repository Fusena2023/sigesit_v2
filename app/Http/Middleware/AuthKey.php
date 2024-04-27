<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //hash(ptig_big)
        $token=$request->header('APP_KEY');
        /*if($token != '$2y$06$9DA3FQogXuK/Lk6FNehW/uyVxHsJ5D9ddrnnP8SorotvjxXhfEJVW'){
            return response()->json(['message'=>'Access denied because app key not found'],401);
        }*/
        return $next($request);
    }
}

