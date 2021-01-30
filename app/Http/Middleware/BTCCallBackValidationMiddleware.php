<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BTCCallBackValidationMiddleware
{

    const CALLBACKSTR = "BtcPaymentData";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(
            $request->has('secret')
            &&
            $request->has('status')
            &&
            $request->has('addr')
            &&
            $request->has('txid')
            &&
            $request->has('value')
            &&
            ($request->secret == self::CALLBACKSTR)
            &&
            ($request->status*1 == 2)
            )
            {
            return $next($request);
        }
        return abort(404);
    }
}
