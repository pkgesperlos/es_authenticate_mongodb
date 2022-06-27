<?php

namespace Esperlos98\EsauthenticationMongo\tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\User;

class VerfiyTest extends TestCase
{

    public function test_verfiy_sucssfull(){
        $user = User::create([
            "username"=> Str::random(20),
            "password"=> bcrypt("password"),
            "password_confirmation"=>  bcrypt("password"),
            "phone" => random_int(9100000000,9199999999),
            "code_verify"=> random_int(000000,999999),
            "email"=> Str::random(30)."@gmail.com",
            "api_token"=>base64_encode(Str::random(250)),  
        ]);

        $response = $this->json("post",env('APP_URL')."/es/api/v1/verfiy",
        [
            "code"=>$user->code_verify,
            "id"=> $user->_id,
        ]);
        

        return $this->assertTrue($response->status() == 200);


    }

    public function test_verfiy_defeat(){

        $user = User::create([
            "username"=> Str::random(20),
            "password"=> bcrypt("password"),
            "password_confirmation"=>  bcrypt("password"),
            "phone" => random_int(9100000000,9199999999),
            "code_verify"=> random_int(000000,999999),
            "email"=> Str::random(30)."@gmail.com",
            "api_token"=>base64_encode(Str::random(250)),  
        ]);
        
        $response = $this->json("post",env('APP_URL')."/es/api/v1/verfiy",
        [
            "code"=>random_int(0000,999999),
            "id"=> $user->_id,
        ]);
        

        return $this->assertTrue($response->status() == 401);
    }

}