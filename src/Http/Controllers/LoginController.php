<?php

namespace Esperlos98\EsauthenticationMongo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Esperlos98\EsauthenticationMongo\Repository\Validate\ValidateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    const ERORR = "Username or password is incorrect";

    public function loginUser(Request $request)
    {
        $validate = resolve(ValidateRequest::class)
            ->validate($request, config("esauthenticationMongo.rules.Login"),
                 config("esauthenticationMongo.massages"));
                 
        if ($validate) {
            return $validate;
        };

        $user = User::where(config("esauthenticationMongo.username")
            ,$request->username)->first();

        if($user){
            return $this->checkPassword($user, $request);
        }

        return  response()->json(self::ERORR, 400);
    }

    public function checkPassword($user, $request)
    {
        if (Hash::check($request->password,$user->password)){
            $token = base64_decode($user->api_token);

            return response()->json(compact('token'))
                ->header('Authorization', 'Bearer '.$token);
        }

        return  response()->json(self::ERORR, 400);
    }
}
