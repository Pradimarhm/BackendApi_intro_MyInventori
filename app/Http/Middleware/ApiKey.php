<?php

namespace App\Http\Middleware;

use Closure;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

use function PHPUnit\Framework\isEmpty;

class ApiKey
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
        $key = $request->header('api_key');
        if (! isEmpty($key) || $key !== config('app.api_key')) {
            return response()->json(['message' => 'Wrong api key'], 401);
            // return new ErrorException('wrong api key');
        }

        return $next($request);
    }
}
