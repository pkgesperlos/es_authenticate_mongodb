<?php

namespace Esperlos98\EsauthenticationMongo\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Esperlos98\EsauthenticationMongo\Repository\Validate\ValidateRequest;

class VerfiyController
{
    public function verfiy(Request $request){

        $validate = resolve(ValidateRequest::class)
            ->validate($request,config("esauthenticationMongo.rules.Verfiy"),
                config("esauthenticationMongo.massages"));

        if($validate){
            return $validate;
        };


       $user = User::find($request->id);
       $check = $this->check( (int)$request?->code, (int)$user?->code_verify);

       if($check){
           $this->statusUpdate($user);
           return  $this->createToken($user->api_token);
       }

       return $this->responseError("Unauthenticated");
    }

    public function check(int $receivedCode,int $savedCode):bool{
        return $receivedCode == $savedCode;
    }

    public function responseError($massage){
        return response()->json($massage,401);
    }

    public function statusUpdate($user){
        $user->status = true ;
        $user->save();
    }

    public function  createToken($token){
        $token = base64_decode($token);

        return response()->json(compact('token'))
         ->header('Authorization', 'Bearer '.$token);
    }
}

?>
