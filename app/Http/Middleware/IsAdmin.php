<?php

namespace App\Http\Middleware;

use Closure, Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::get('role') == 'Admin'){
            return redirect('/admin')->with('error', 'Anda tidak login sebagai user');
        }
        return $next($request);
    }
}
