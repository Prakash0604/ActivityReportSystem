<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyActivityController;
use App\Http\Controllers\RoleController;
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

        // User
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user/create', [UserController::class, 'store'])->name('user.store');
        Route::get('fetch/status/{id}',[UserController::class,'fetchStatus']);
        Route::post('user/status/update/{id}',[UserController::class,'updateStatus']);
        Route::post('user/password/update/{id}',[UserController::class,'updatePassword']);
        Route::get('user/detail/show/{id}',[UserController::class,'fetchUserData']);
        Route::post('user/detail/update/{id}',[UserController::class,'updateDdetail']);

        // Role
        Route::get('role',[RoleController::class,'index'])->name('role.index');
        Route::post('role/create',[RoleController::class,'store'])->name('role.store');
        Route::get('role/get/{id}',[RoleController::class,'getRole'])->name('role.get');
        Route::post('role/update/{id}',[RoleController::class,'update'])->name('role.update');
        Route::get('role/delete/{id}',[RoleController::class,'destory'])->name('role.destory');

        Route::get('task',[DailyActivityController::class,'index'])->name('task.index');
        Route::post('task/add',[DailyActivityController::class,'store'])->name('task.store');
        Route::get('task/edit/{id}',[DailyActivityController::class,'edit'])->name('task.edit');
        Route::post('task/update/{id}',[DailyActivityController::class,'update'])->name('task.update');

        Route::get('task/detail/{id}',[DailyActivityController::class,'taskDetail'])->name('task.details');




        Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
    });
});
