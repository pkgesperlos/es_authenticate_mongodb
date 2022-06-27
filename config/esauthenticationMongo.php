<?php

use Illuminate\Http\Request;

return [

    "rules" => [
        "Register" => [
            'username' => 'required',
            'email' => 'required|email|unique:mongodb.users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|unique:mongodb.users',
            'status' => 'boolean',
            'api_token' => 'unique:mongodb.users'
        ],

        "Login" => [
            'username' => 'required',
            'password' => 'required',
        ],

        "Verfiy"=>[
            'id' => 'required',
            'code' => 'required|numeric',
        ],
    ],

    "massages" => [
        "required" => 601,
        "confirmed" => 602,
        "min" => 603,
        "email" => 604,
        "unique" => 605,
        "numeric" => 606,
    ],

    "userFileds" => [
        "username" => "username",
        "phone" => "phone",
        "email" => "email",
        "password" => "password",
        "code_verify" => "code_verify",
        "status" => "status"
    ],

    "username" => "phone",
    "safeCode" => true,

];
