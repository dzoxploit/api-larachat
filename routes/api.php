<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserBasicInfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatInteractionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group( function () {
    Route::get('basic-info', [UserBasicInfoController::class, 'index']);
    Route::post('basic-info/edit', [UserBasicInfoController::class, 'edit']);

    Route::get('contact', [ContactController::class, 'index']);
    Route::post('contact/create', [ContactController::class, 'create']);
    Route::post('contact/delete/{id}', [ContactController::class, 'delete']);

    Route::get('chat-interaction', [ChatInteractionController::class, 'index']);
    Route::post('chat-interaction/create', [ChatInteractionController::class, 'create']);
});