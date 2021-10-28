<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AuthenticateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\WardController;

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
Route::post('/send-verify-mail', [ApplicationController::class, 'sendVerifyEmail']);
Route::post('/verify-email', [ApplicationController::class, 'verifyEmail']);
Route::post('/applications', [ApplicationController::class, 'store']);


Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthenticateController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'login']);
    Route::get('/forgot-password', [AuthenticateController::class, 'forgotPasswordForm']);
    Route::post('/forgot-password', [AuthenticateController::class, 'forgotPassword']);
    Route::get('/reset-password/{token}', [AuthenticateController::class, 'resetForm'])->name('password.reset');
    Route::put('/reset-password', [AuthenticateController::class, 'reset']);
    
    Route::get('/district/{id}/wards', [WardController::class, 'index']);
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('backend.index');
        });
        Route::get('/logout', [AuthenticateController::class, 'logout']);
        Route::get('/profile', [UserController::class, 'showProfile']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
        Route::get('/unit', [UnitController::class, 'index']);
        Route::put('/district', [DistrictController::class, 'update']);
        Route::put('/ward', [WardController::class, 'update']);
        Route::get('/district/{id}/wards/active-all', [WardController::class, 'activeAll']);

        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/check-username-existed', [UserController::class, 'checkUserExisted']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}', [UserController::class, 'edit']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users', [UserController::class, 'destroy']);
    });
});