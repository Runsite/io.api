<?php 

namespace App\Libraries;

use Illuminate\Http\Request;
use App\Models\AccessToken;

class Token {

    /**
     * Checking access token from request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function isValid(Request $request) : bool
    {
        $token = $request->header('Authorization');
        $domain = $request->header('host');

        return ! empty($token) and ! empty($token) and AccessToken::where('token', $token)->where('domain', $domain)->exists();
    }
}
