<?php

use Illuminate\Http\Request;

return [

    "rules" => [
        "Register" => [
            'username' => 'required',
            'email' => 'required|email|unique:mongodb.users',
            'password' => 'required|confirmed|min:8'
        ],

        "Login" => [
            'username' => 'required|email',
            'password' => 'required',
        ],
    ],

    "massages" => [
        "required" => 601,
        "confirmed" => 602,
        "min" => 603,
        "email" => 604,
        "unique" => 605
    ],

    "userFileds" => [
        "username" => "username",
        "email" => "email",
        "password" => "password",
    ],

    "username" => "email",

];
