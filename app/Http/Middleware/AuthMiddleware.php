<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*
        //
        //echo '<br>First Middleware';
        if (!$request->session()->exists('profile_id')) {
            // user value cannot be found in session
            return redirect('/login');
        }
        */

        
        if (Session::has('company_id'))
        {
            return redirect('login');
        }
        else
        {
            return redirect('login');
        }
        
        //echo '<br>First Middleware';
        return $next($request);
    }
}
