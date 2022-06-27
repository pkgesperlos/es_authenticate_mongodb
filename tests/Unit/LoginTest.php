<?php

namespace Esperlos98\EsauthenticationMongo\tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class LoginTest extends TestCase
{

    public function test_login_successful(){
         $user = User::create([
             "username"=> Str::random(20),
             "password"=> bcrypt("password"),
             "password_confirmation"=>  bcrypt("password"),
             "phone" => random_int(9100000000,9199999999),
             "code_verify"=> random_int(0000,999999),
             "email"=> Str::random(30)."@gmail.com",
             "api_token"=>base64_encode(Str::random(250)),  
         ]);

        $response = $this->json("post",env('APP_URL')."/es/api/v1/login",
            ["username"=>$user->phone,"password"=>"password"]);
        
        return $this->assertTrue($response->status() == 200);
    }

    public function test_login_defeat(){
        
        $response = $this->json("post",env('APP_URL')."/es/api/v1/login",
            ["email"=>"test@gmail.com","password"=>"mistakepassword"]);
    
        return $this->assertTrue($response->status() == 400);
    }
}

?>