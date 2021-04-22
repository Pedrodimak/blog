<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
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

/*Ruta página principal -----------------------------------------------*/
    Route::view('/', 'home')->name('home');
    

/*Ruta página de registro --------------------------------------------- */
    Route::view('/register', 'register')->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

/*Ruta página de acceso ------------------------------------------------ */
    Route::view('/login', 'login')->name('login');
    Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

/*Ruta de posts -------------------------------------------------------- */
    //Route::view('/post', [PostController::class, 'show'])->name('posts.show');

/*Grupo de rutas middleware --------------------------------------------- */
    Route::middleware('logged')->group( function() {
        
        Route::view('/logged/home', 'logged.home-logged')->name('logged.home-logged');
        Route::get('/logged/logout', [LoginController::class, 'logout'])->name('logged.logout');
        
        Route::get('/logged/edit', [LoginController::class, 'edit'])->name('logged.edit-user');
        Route::patch('/logged/update', [LoginController::class, 'update'])->name('logged.update-user');
        
        Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/post/{post:id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/post/{post:id}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('/post/{post:id}/delete', [PostController::class, 'destroy'])->name('post.delete');
    });

    /*Route::middleware('posts')->group(function() {
        Route::view('/post/edit', [PostController::class, 'edit'])->name('post.edit');
    });*/
    
    