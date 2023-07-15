<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    	if(!Session::has('loginId') || !Session::has('role')){
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
        }
        return $next($request);
    }
}
