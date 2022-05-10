<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FirstAccess
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
        $cookieAlert = Cookie::get('firstAccess');
        if(!$cookieAlert){
            echo "<script>alert('Account admin: hieptvh18@gmail.com Password: 123123')</script>";  
            Cookie::queue('firstAccess','welcome to kooding',43200);
        } 
        return $next($request);
    }
}
