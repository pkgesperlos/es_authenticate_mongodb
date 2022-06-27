<?php

namespace Esperlos98\EsauthenticationMongo\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Esperlos98\EsauthenticationMongo\Repository\Validate\ValidateRequest;
use Esperlos98\EsauthenticationMongo\Lib\Config\FiledCreateUser;

class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        $validate = resolve(ValidateRequest::class)
            ->validate($request,config("esauthenticationMongo.rules.Register"),
                config("esauthenticationMongo.massages"));
        if($validate){
            return $validate;
        };

        $fileds = new FiledCreateUser($request);
        $user = User::create($fileds->fileds);

        return response()->json($user->_id,200);
    }
}
