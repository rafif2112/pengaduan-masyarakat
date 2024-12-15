<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponseProgresController;
use App\Http\Controllers\UserController;
use App\Models\Response;

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


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('landing_page');
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [LoginController::class, 'create'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.proccess');
});

Route::middleware(['islogin'])->group(function () {
    Route::middleware(['isGuest'])->group(function () {
        Route::prefix('/report')->name('report.')->group(function () {
            Route::get('/article', [ArticleController::class, 'index'])->name('article');
            Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
            Route::get('/create', [ReportController::class, 'create'])->name('create');
            Route::post('/create', [ReportController::class, 'store'])->name('store');
            Route::get('/me', [ReportController::class, 'index'])->name('index');
            Route::post('/comment', [CommentController::class, 'store'])->name('comment');
            Route::delete('/hapus/{id}', [ReportController::class, 'destroy'])->name('delete');
            Route::patch('/article/vote/{id}', [ArticleController::class, 'vote'])->name('article.vote');
        });
    });
    
    Route::middleware(['isStaff'])->group(function () {
        Route::prefix('/report')->name('staff.report.')->group(function () {
            Route::get('/', [ReportController::class, 'staffIndex'])->name('index');
            Route::post('/export', [ReportController::class, 'export'])->name('export');
        });
        Route::prefix('/response')->name('staff.response.')->group(function () {
            Route::post('/report/{id}', [ResponseController::class, 'store'])->name('store');
            Route::post('/progres/{id}', [ResponseProgresController::class, 'store'])->name('progres.create');
            Route::delete('/progres/{id}', [ResponseProgresController::class, 'destroy'])->name('progres.delete');
            Route::patch('/report/{id}', [ResponseController::class, 'update'])->name('update');
            Route::get('/report/view/{id}', [ResponseController::class, 'viewResponse'])->name('view');
        });
    });
    
    Route::middleware(['isHeadStaff'])->group(function () {
        Route::prefix('/report')->name('head_staff.')->group(function () {
            Route::get('/dashboard', [ReportController::class, 'headStaffIndex'])->name('index'); 
        });
        Route::prefix('/user')->name('head_staff.user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/create', [UserController::class, 'store'])->name('create');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
            Route::patch('/reset/{id}', [UserController::class, 'update'])->name('reset');
        });
    });
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
});