<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminProfileController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware(['admin'])->group(function () {
        
        ##------------------------------------------------------- ADMIN INDEX PAGE
        Route::get('/', AdminHomeController::class)->name('index');
        
        ##------------------------------------------------------- VISITS MODULE
        Route::controller(VisitController::class)->group(function () {
            Route::resource('visits', VisitController::class)->only('store');
        });

        ##------------------------------------------------------- CALLS MODULE
        Route::controller(CallController::class)->group(function () {
            Route::resource('calls', CallController::class)->only('store');
        });

        ##------------------------------------------------------- USERS MODULE
        Route::controller(UserController::class)->group(function () {            
            Route::get('/actions/{user}/{action}', [UserController::class, 'actions'])->name('users.actions');
            Route::resource('users', UserController::class);
        });

        ##------------------------------------------------------- ROLES MODULE
        Route::controller(RoleController::class)->group(function () {
            Route::resource('roles', RoleController::class);
        });
        
        ##------------------------------------------------------- ADMINS MODULE
        Route::controller(AdminController::class)->group(function () {
            Route::resource('admins', AdminController::class);
        });
        
        ##------------------------------------------------------- ADMIN PROFILE SECTION
        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
            Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile');
            Route::post('/password', [AdminProfileController::class, 'updatePassword'])->name('changePassword');
        });
        
    });

    require __DIR__.'/adminAuth.php';

});
