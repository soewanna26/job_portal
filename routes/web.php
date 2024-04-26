<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post("/process-register", [AccountController::class, 'processRegister'])->name('account.processRegister');
        Route::get("/login", [AccountController::class, 'login'])->name('account.login');
        Route::post("/authenticate", [AccountController::class, 'authenticate'])->name('account.authenticate');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get("/profile", [AccountController::class, 'profile'])->name('account.profile');
        Route::put("/update-profile", [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post("/update-profile-pic", [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get("/logout", [AccountController::class, 'logout'])->name('account.logout');

        Route::get("/create-job", [AccountController::class, 'createJob'])->name('account.createJob');
        Route::post("/save-job", [AccountController::class, 'saveJob'])->name('account.saveJob');
        Route::get("/get-job", [AccountController::class, 'myJob'])->name('account.myJob');
    });
});
