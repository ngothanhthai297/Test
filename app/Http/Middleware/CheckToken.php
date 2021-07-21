<?php

namespace App\Http\Middleware;

use Closure;
use App\SessionUser;

class CheckToken
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
        $token = $request->header('token');
        $checkToken = SessionUser::where('token',$token)->first();
        if(empty($token)){
            return response()->json("Khong co token",401);
        }else if(empty($checkToken)){
            return response()->json("Token khong hop le",401);
        }else{
            return $next($request);
        }
    }
}
