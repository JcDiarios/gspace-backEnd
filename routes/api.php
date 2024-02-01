<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GspaceController;
/*
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//api methods GET, POST, PUT, PATCH, and DELETE.

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

//this is auth guard for app that need authentication
Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::get("/gspace", [GspaceController::class, "index"]);
    Route::post("/gspace", [GspaceController::class, "store"]);
    Route::get("/gspace/{id}", [GspaceController::class, "show"]);
    Route::post("/logout", [AuthController::class, "logout"]); 
});


