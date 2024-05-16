<?php

use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('login', [FrontendLoginController::class,'index'])->name('frontend.login');
Route::post('login', [FrontendLoginController::class,'store'])->name('frontend.store');
Route::get('logout', [FrontendLoginController::class,'logout'])->name('frontend.logout');

Route::get('register', [FrontendLoginController::class, 'register'])->name('frontend.register');


// Route::get('login-qr-code', [FrontendLoginController::class, 'loginQr'])->name('frontend.loginqr');
// Route::get('login-qr-code/verify', [FrontendLoginController::class, 'qrVerity'])->name('frontend.loginqrverity');


Route::prefix('users')->group(function(){
    Route::group(['middleware' => 'frontend'], function(){
        Route::get('/', [UserController::class, 'index'])->name('frontend.users.index');

    });
});





