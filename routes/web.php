<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AuthenticateController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ApplicationController::class, 'create']);
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthenticateController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'login']);
    Route::get('/forgot-password', [AuthenticateController::class, 'forgotPasswordForm']);
    Route::post('/forgot-password', [AuthenticateController::class, 'forgotPassword']);
    Route::get('/reset-password/{token}', [AuthenticateController::class, 'resetForm'])->name('password.reset');
    Route::put('/reset-password', [AuthenticateController::class, 'reset']);
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('backend.index');
        });
        Route::get('/logout', [AuthenticateController::class, 'logout']);
        Route::get('/profile', [UserController::class, 'showProfile']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
    });
});