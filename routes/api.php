<?php

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;

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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);
Route::get('show_login', [AuthController::class, 'showLogin'])->name('show_login');

Route::prefix('users')->group(function () {
    Route::post('create', [UserController::class, 'store']);
    Route::get('index', [UserController::class, 'index']);
    Route::get('show/{id}', [UserController::class, 'show']);
    Route::put('update/{id}', [UserController::class, 'update'])->middleware('role');
    Route::delete('delete/{id}', [UserController::class, 'destroy'])->middleware('role');
});
