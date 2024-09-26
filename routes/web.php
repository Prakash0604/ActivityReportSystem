<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('is_login')->group(function () {
    Route::get('/', function () {
        return view('Auth.login');
    });
    Route::post('/', [AuthController::class, 'login']);
    Route::get('/admin/register', [AuthController::class, 'index']);
    Route::post('/admin/register', [AuthController::class, 'store']);
});



Route::prefix('admin')->group(function () {
    Route::middleware('authUser')->group(function () {

        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user/create', [UserController::class, 'store'])->name('user.store');
        Route::get('fetch/status/{id}',[UserController::class,'fetchStatus']);
        Route::post('user/status/update/{id}',[UserController::class,'updateStatus']);
        Route::post('user/password/update/{id}',[UserController::class,'updatePassword']);
        Route::get('user/detail/show/{id}',[UserController::class,'fetchUserData']);
        Route::post('user/detail/update/{id}',[UserController::class,'updateDdetail']);




        Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
    });
});
