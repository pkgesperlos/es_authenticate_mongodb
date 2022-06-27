<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Esperlos98\EsauthenticationMongo\Http\Controllers\{LoginController,RegisterController,VerfiyController};

Route::middleware(['api'])->prefix("es/api/v1/")->group(function () {
    Route::post("/login",[LoginController::class,'loginUser']);
    Route::post("/register",[RegisterController::class,'registerUser']);
    Route::post("/verfiy",[VerfiyController::class,'verfiy']);
});
