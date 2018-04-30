<?php

namespace App\Http\Middleware;

use Closure;
use App\AccessToken;

class CheckAccessToken
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
        $token = $request->header('Authorization');

        if(! AccessToken::where('token', $token))
        {
            return response('Not valid token provider.', 401);
        }

        return $next($request);
    }
}
