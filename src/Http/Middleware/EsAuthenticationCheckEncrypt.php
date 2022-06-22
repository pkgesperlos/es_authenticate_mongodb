<?php

namespace Esperlos98\EsauthenticationMongo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EsAuthenticationCheckEncrypt
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->headers->get("authorization");

        if($token){
            $token = trim($token,"Bearer ");
            $request->headers->set("authorization","Bearer ".base64_encode($token));
        }

        return $next($request);
    }
}
