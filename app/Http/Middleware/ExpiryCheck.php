<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;


class ExpiryCheck
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
        // check hạn sử dụng voucher và => status
        $vouchers = Voucher::all();
        $currentTime = strtotime(Carbon::now());

        foreach($vouchers as $voucher){
            if(strtotime($voucher->expired_date) <= $currentTime){
                // update lai status
                $voucher->status = 0;
                $voucher->save();
            }
        }

        return $next($request);
    }
}
