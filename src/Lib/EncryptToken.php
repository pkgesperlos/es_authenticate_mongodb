<?php

namespace Esperlos98\EsauthenticationMongo\Lib;

class EncryptToken
{
    public static function encryptToken($token)
    {
        return base64_encode($token);
    }   
}

?>
