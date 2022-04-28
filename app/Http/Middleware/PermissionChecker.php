<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PermissionChecker //cho phep lam gi?
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$roles)
    {
        // check role admin = middleware (co the dung attemp check trong controller)
        if(Auth::check()){
            // kiem tra ng dung hien tai co khop voi cac role cho phep truy cap hay k o route
             if(in_array(Auth::user()->getStrRole(),explode('|',$roles))){
                return $next($request);
            }
            return redirect(route('403'));
       }

        return redirect(route('client.home'));
    }
}
