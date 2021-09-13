<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Jobs\AuthLog;


class LogUserAuthentication
{
    public function handle(Request $request, Closure $next)
    {    
        $details = array(
            "ip" => $request->ip(),
            "routeName" => $request->route()->getName()
        );

        AuthLog::dispatch($details);
     
        return $next($request); 
    }
}
