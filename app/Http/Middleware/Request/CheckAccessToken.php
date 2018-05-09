<?php

namespace App\Http\Middleware\Request;

use Closure;
use App\Libraries\Token;

class CheckAccessToken
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $this->token->isValid($request))
        {
            return response('Not valid token provider.', 401);
        }

        return $next($request);
    }
}
