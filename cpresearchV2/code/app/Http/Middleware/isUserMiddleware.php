<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class isUserMiddleware
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
        if( Auth::check() && Auth::user()->hasRole('Student')){
            return $next($request);
        }
        elseif( Auth::check() && Auth::user()->hasRole('Teacher')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('Staff')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('Public Relations Officer')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('Educator')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('Master Student')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('System Administrator')){
            return $next($request);
        }
        else{
            return redirect()->route('login');
        }
    }
}
