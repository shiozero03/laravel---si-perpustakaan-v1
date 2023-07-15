<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::get('role') == 'User'){
            return redirect('/user')->with('error', 'Anda tidak login sebagai admin');
        }
        return $next($request);
    }
}
