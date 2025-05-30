<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }
            if( Auth::guard($guard)->check() && Auth::user()->hasRole('admin')){
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('teacher')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('student')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('staff')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('Public Relations Officer')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('Educator')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('System Administrator')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }elseif( Auth::guard($guard)->check() && Auth::user()->hasRole('Master Student')){
                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('dashboard');
            }
            
        }
        return $next($request);
    }
}
