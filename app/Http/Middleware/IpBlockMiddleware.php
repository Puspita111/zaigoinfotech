<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpBlockMiddleware
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

        $data=\App\Models\WhitelistIp::where('status',1)->get();
        foreach($data as $ips){
           $ip[]=$ips->ip_address;
        }
        if(! in_array($request->ip(),$ip)){
            abort(403);
        }
        return $next($request);
    }
}
