<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


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
        
        ##------------------------------------------------------- ROLES MODULE
        Route::controller(RoleController::class)->group(function () {
            Route::resource('roles', RoleController::class);
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
