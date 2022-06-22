<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Esperlos98\EsauthenticationMongo\Http\Controllers\LoginController;
use Esperlos98\EsauthenticationMongo\Http\Controllers\RegisterController;


Route::middleware(['api'])->prefix("api/es/v1/")->group(function () {
    Route::post("/login",[LoginController::class,'loginUser']);
    Route::post("/register",[RegisterController::class,'registerUser']);
});
