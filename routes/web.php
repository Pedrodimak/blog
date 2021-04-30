<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeLoggedController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

/*Grupo de rutas middleware logged (cuando inicias sesión tienes acceso a estas rutas)---------- */
    Route::middleware('no_logged')->group( function() {
    /*Ruta página principal -----------------------------------------------*/
        Route::get('/', [HomeController::class, 'index'])->name('home');
        

    /*Ruta página de registro --------------------------------------------- */
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

    /*Ruta página de acceso ------------------------------------------------ */
        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login/authenticate', [LoginController::class, 'index'])->name('login.authenticate');
    });

/*Grupo de rutas middleware logged (cuando inicias sesión tienes acceso a estas rutas)---------- */
    Route::middleware('logged')->group( function() {
        
        Route::get('/logged/home', [HomeLoggedController::class, 'show'])->name('logged.home-logged');
        Route::get('/logged/logout', [LogoutController::class, 'index'])->name('logged.logout');
        
        Route::get('/logged/edit', [UserController::class, 'edit'])->name('logged.edit-user');
        Route::patch('/logged/update', [UserController::class, 'update'])->name('logged.update-user');
        
        Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/post/{post:id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/post/{post:id}/update', [PostController::class, 'update'])->name('post.update');
        Route::delete('/post/{post:id}/delete', [PostController::class, 'destroy'])->name('post.delete');
    
    });

    
    