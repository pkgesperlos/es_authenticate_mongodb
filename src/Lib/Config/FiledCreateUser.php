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
        $code = $this->createCode(config("esauthenticationMongo.safeCode") );

        foreach (config("esauthenticationMongo.userFileds") as $userFiled) {
            if ($userFiled == "password") {
                $this->fileds +=  [$userFiled => bcrypt($request->get($userFiled))];
                $this->fileds += ["api_token" => EncryptToken::encryptToken($this->tokenWithoutEncrypt)];
                $this->fileds += ["code_verify" => $code];
                $this->fileds += ["status"=>false];
            } else {
                $this->fileds +=  [$userFiled => $request->get($userFiled)];
            }
        }
    }

    public function createCode(bool $typeCount): int
    {
        $sixStartNumber = 100000;
        $sixEndNumber = 999999;
        $fourStartNumber = 1000;
        $fourEndNumber = 9999;

        if ($typeCount) {
            return random_int($sixStartNumber, $sixEndNumber);
        } else {
            return random_int($fourStartNumber, $fourEndNumber);
        }
    }
}
