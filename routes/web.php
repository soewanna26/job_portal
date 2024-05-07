<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController as AdminJobController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/job/detail/{id}', [JobController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobController::class, 'applyJob'])->name('applyJob');
Route::post('/save-job', [JobController::class, 'saveJob'])->name('saveJob');

Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
    Route::get('/dashborad', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs');
    Route::get("/create-job", [AdminJobController::class, 'createJob'])->name('admin.createJob');
    Route::post("/save-job", [AdminJobController::class, 'saveJob'])->name('admin.saveJob');
    Route::get('/jobs/edit/{id}', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/jobs/update/{id}', [AdminJobController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/job/delete', [AdminJobController::class, 'destroy'])->name('admin.jobs.destroy');

    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('admin.job-applications');
    Route::delete('/job-application/delete', [JobApplicationController::class, 'destroy'])->name('admin.job-applications.destroy');
});
Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post("/process-register", [AccountController::class, 'processRegister'])->name('account.processRegister');
        Route::get("/login", [AccountController::class, 'login'])->name('account.login');
        Route::post("/authenticate", [AccountController::class, 'authenticate'])->name('account.authenticate');

        Route::get("/forgot-password", [AccountController::class, 'forgotPassword'])->name('account.forgotPassword');
        Route::post("/process-forgot-password", [AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');
        Route::get("/reset-password/{token}", [AccountController::class, 'resetPassword'])->name('account.resetPassword');
        Route::post("/process-rest-password", [AccountController::class, 'processRestPassword'])->name('account.processRestPassword');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get("/profile", [AccountController::class, 'profile'])->name('account.profile');
        Route::put("/update-profile", [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post("/update-password", [AccountController::class, 'updatePassword'])->name('account.updatePassword');
        Route::post("/update-profile-pic", [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get("/logout", [AccountController::class, 'logout'])->name('account.logout');

        // Route::get("/create-job", [AccountController::class, 'createJob'])->name('account.createJob');
        // Route::post("/save-job", [AccountController::class, 'saveJob'])->name('account.saveJob');
        Route::get("/my-job", [AccountController::class, 'myJob'])->name('account.myJob');
        Route::get("/my-job/edit/{jobId}", [AccountController::class, 'editJob'])->name('account.editJob');
        Route::put("/update-job/{jobId}", [AccountController::class, 'updateJob'])->name('account.updateJob');
        Route::post('/deleteJob', [AccountController::class, 'deleteJob'])->name('account.deleteJob');

        Route::get('/my-job-applications', [AccountController::class, 'myJobApplications'])->name('account.myJobApplications');
        Route::post('/remove-job', [AccountController::class, 'removeJobs'])->name('account.removeJobs');

        Route::get('/saved-job', [AccountController::class, 'savedJobs'])->name('account.savedJobs');
        Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
    });
});
