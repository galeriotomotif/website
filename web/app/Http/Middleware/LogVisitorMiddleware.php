<?php

namespace App\Http\Middleware;

use App\LogVisitor;
use Closure;

class LogVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(LogVisitor::findByIp($request->ip())){

        }
        try {
            LogVisitor::createData(
                [
                    'ip' => $request->ip(),
                    'host' => gethostbyaddr($request->ip())
                ]
            );
        } catch (\Throwable $th) {
            return $next($request);
        }


        return $next($request);
    }
}
