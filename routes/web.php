<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'showLoginForm'] );


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('create-product');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('products-detail');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('products-delete');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('products-update');
        Route::post('/', [ProductController::class, 'store']);
    });
    Route::prefix('invitations')->group(function () {
        Route::get('/', [InvitationController::class, 'index'])->name('invitations');
        Route::get('/create', [InvitationController::class, 'create'])->name('invitations-create');
        Route::get('/show/{token}', [InvitationController::class, 'show'])->name('invitations-detail');
        Route::put('/update/{token}', [InvitationController::class, 'update'])->name('invitations-update');
        Route::post('/', [InvitationController::class, 'store']);
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users-create');
        Route::get('/show/{token}', [UserController::class, 'show'])->name('users-detail');
        Route::put('/update/{token}', [UserController::class, 'update'])->name('users-update');
        Route::post('/', [UserController::class, 'store']);
    });
});

