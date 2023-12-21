<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LetterTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLogin;

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

Route::get('/', function () {return view('login');})->name('login');

Route::post('/auth', [UserController::class, 'loginAuth'])->name('login.auth');

Route::middleware('IsLogin')->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/error-permission', function(){return view('errors.permission');})->name('error.permission');
});


Route::middleware('IsLogin', 'IsTu')->group(function(){

    Route::prefix('/user')->name('user.')->group(function() {
            Route::prefix('/tu')->name('tu.')->group(function() {
                Route::get('/dashboard',[Dashboard::class, 'dashboard'])->name('dashboard.page');
                Route::get('/index', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
            });


    });


    Route::prefix('/surat')->name('surat.')->group(function() {
        Route::prefix('/tu')->name('tu.')->group(function(){
            Route::prefix('/klasifikasi')->name('klasifikasi.')->group(function() {
                Route::get('/index', [LetterTypeController::class, 'index'])->name('index');
                Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
                Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
                Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
                Route::get('/detail/{id}', [LetterTypeController::class, 'detail'])->name('detail');
                Route::get('/export-excel', [LetterTypeController::class, 'export_excel'])->name('export.excel');

            });

            Route::prefix('/data')->name('data.')->group(function() {
                Route::get('/index', [LetterController::class, 'index'])->name('index');
                Route::get('/create', [LetterController::class, 'create'])->name('create');
                Route::post('/store', [LetterController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [LetterController::class, 'edit'])->name('edit');
                Route::patch('/update/{id}', [LetterController::class, 'update'])->name('update');
                Route::delete('/{id}', [LetterController::class, 'destroy'])->name('delete');
                // Route::get('/PDF/{id}', [LetterController::class, 'PDF'])->name('PDF');
            });

            Route::get('/downloadPDF/{id}', [LetterController::class, 'downloadPDF'])->name('download');


        });
        });



});


        Route::middleware('IsLogin', 'IsGuru')->group(function(){
                Route::prefix('/user')->name('user.')->group(function() {
                   Route::prefix('/guru')->name('guru.')->group(function(){
                    //    Route::get('/', function() {return view('/user/guru/dashboard');})->name('dashboard.page');
                       Route::get('/', [Dashboard::class, 'dashboardGuru'])->name('dashboard.page');
                       Route::get('/index', [UserController::class, 'indexGuru'])->name('index');
                       Route::get('/create', [UserController::class, 'createGuru'])->name('create');
                       Route::post('/store', [UserController::class, 'storeGuru'])->name('store');
                       Route::get('/{id}', [UserController::class, 'editGuru'])->name('edit');
                       Route::patch('/{id}', [UserController::class, 'updateGuru'])->name('update');
                       Route::delete('/{id}', [UserController::class, 'destroyGuru'])->name('delete');
                   });
            });
        });



