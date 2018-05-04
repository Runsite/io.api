<?php

namespace App\Http\Middleware;

use Closure;
use Facades\Spatie\Referer\Referer;
use App\Models\AccessToken;

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
        $domain = $request->header('host');

        if(! $token or ! AccessToken::where('token', $token)->where('domain', $domain)->count())
        {
            return response('Not valid token provider.', 401);
        }

        return $next($request);
    }
}
