<?php

namespace Esperlos98\EsauthenticationMongo\Lib\Config;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Esperlos98\EsauthenticationMongo\Lib\EncryptToken;

class FiledCreateUser
{
    public $fileds = [];
    public $request;
    const RANDOMSIZE = 250;
    public  $tokenWithoutEncrypt;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->tokenWithoutEncrypt = Str::random(self::RANDOMSIZE);

        foreach (config("esauthenticationMongo.userFileds") as $userFiled) {
            if ($userFiled == "password") {
                $this->fileds +=  [$userFiled => bcrypt($request->get($userFiled))];
                $this->fileds += ["api_token" => EncryptToken::encryptToken($this->tokenWithoutEncrypt)];
            } else {
                $this->fileds +=  [$userFiled => $request->get($userFiled)];
            }
        }
    }
}
