<?php

use App\Http\Controllers\Auth\BackendLoginController;
use App\Http\Controllers\backend\Admins\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Dashboard\DashBoardController;
use App\Http\Controllers\backend\Schedules\ScheduleController;
use App\Http\Controllers\backend\Subjects\SubjectController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/backend_login', [BackendLoginController::class,'create'])->name('backend.login');

Route::post('/backend_login', [BackendLoginController::class,'login'])->name('backend.user.login');

Route::get('/backend_logout', [BackendLoginController::class, 'logout'])->name('backend.user.logout');
//

//Route::get('admin/dashboard', [DashBoardController::class,'index'])->name('backend.dashboard');
   
// Route::get('/admin/admins', [AdminController::class, 'index'])->name('backend.admins.index');
// Route::get('/admin/admins/edit/{id}', [AdminController::class, 'edit'])->name('backend.admins.edit');
// Route::get('/admin/admins/update/{id}', [AdminController::class, 'update'])->name('backend.admins.update');
// Route::delete('admin/admins/{id}', [AdminController::class, 'destroy'])->name('backend.admins.destroy');


Route::prefix('admin')->group(function(){
    Route::group(['middleware' => 'backend'], function(){
     //dashboard route
     Route::get('/', [DashBoardController::class,'index'])->name('backend.index');
     Route::get('/dashboard', [DashBoardController::class,'index'])->name('backend.dashboard');
   
      //show all admin
     Route::prefix('admins')->group(function(){
     Route::get('/', [AdminController::class, 'index'])->name('backend.admins.index');
     Route::get('/create', [AdminController::class, 'create'])->name('backend.admins.create');
     Route::post('/store', [AdminController::class, 'store'])->name('backend.admins.store');
     Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('backend.admins.edit');

     Route::put('/update/{id}', [AdminController::class, 'update'])->name('backend.admins.update');
     Route::delete('/{id}', [AdminController::class, 'destroy'])->name('backend.admins.destroy');
    });
    //Subject
      Route::prefix('subjects')->group(function(){
      Route::get('/', [SubjectController::class, 'index'])->name('backend.subjects.index');
      Route::get('/create', [SubjectController::class, 'create'])->name('backend.subjects.create');
      Route::post('/store', [SubjectController::class, 'store'])->name('backend.subjects.store');
      Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('backend.subjects.edit');
 
      Route::put('/update/{id}', [SubjectController::class, 'update'])->name('backend.subjects.update');
      Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('backend.subjects.destroy');
    });

     //Schedule
     Route::prefix('schedules')->group(function(){
      Route::get('/',[ScheduleController::class, 'index'])->name('backend.schedules.index');
      Route::get('/create',[ScheduleController::class, 'create'])->name('backend.schedules.create');
      Route::post('/store',[ScheduleController::class, 'store'])->name('backend.schedules.store');
      Route::get('/edit/{id}',[ScheduleController::class, 'edit'])->name('backend.schedules.edit');
      Route::put('/update/{id}',[ScheduleController::class, 'update'])->name('backend.schedules.update');
      Route::get('/{id}', [ScheduleController::class, 'destroy'])->name('backend.schedules.destroy');
      Route::delete('/{id}', [ScheduleController::class, 'deleteAjax'])->name('backend.schedules.deleteAjax');

    });

  });
  
});






