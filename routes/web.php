<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\BookController;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminBookController;


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





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*admin routes*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Add this route if missing
    Route::get('login', [AdminAuthController::class, 'index'])->name('login'); 
    Route::post('check', [AdminAuthController::class, 'checklogin'])->name('check');

});


Route::prefix('admin')->as('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('show', [AdminBookController::class, 'index'])->name('show.index');
});

/*user routes*/
Route::get('/login', [CustomerAuthController::class, 'index'])->name('login');
Route::post('/custom-login', [CustomerAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/registration', [CustomerAuthController::class, 'registration'])->name('register-user');
Route::post('/custom-registration', [CustomerAuthController::class, 'customRegistration'])->name('register.custom');

Route::middleware(['auth','is_user'])->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/booking', [BookController::class, 'index'])->name('booking.index');
    Route::post('/book', [BookController::class, 'book'])->name('book');
    Route::post('/submit', [BookController::class, 'submit'])->name('submit');
    
    
});

Route::get('signout', [CustomerAuthController::class, 'signOut'])->name('signout');

