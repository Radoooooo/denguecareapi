<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response(
        ['message' => 'api is working'],
        200
    );
});


Route::post('adminlogin',[AuthenticationController::class,'adminlogin']);
Route::post('adminregister',[AuthenticationController::class,'adminregister']);
Route::post('register',[AuthenticationController::class,'register']);
Route::post('login',[AuthenticationController::class,'login']);
Route::post('logoutUser',[AuthenticationController::class,'logoutUser']);
Route::post('logoutAdmin',[AuthenticationController::class,'logoutAdmin']);