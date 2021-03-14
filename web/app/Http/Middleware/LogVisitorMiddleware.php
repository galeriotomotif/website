<?php

namespace App\Http\Middleware;

use Closure;
use App\LogVisitor;

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
        try {
            if ($log = LogVisitor::findByIp($request->ip())) {
                $log->addCount();
            } else {
                LogVisitor::createData(
                    [
                        'ip' => $request->ip(),
                        'host' => gethostbyaddr($request->ip()),
                        'count' => 1
                    ]
                );
            }
        } catch (\Throwable $th) {
            return $next($request);
        }

        return $next($request);
    }
}
