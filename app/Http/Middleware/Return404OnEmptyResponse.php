<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class Return404OnEmptyResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
            if($response->original == null || $response->original == "" || $response->original == []){
                return response('not found',404);
            }
        return $next($request);
    }
}
