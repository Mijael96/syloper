<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;


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
Route::get('/', [PostsController::class, 'postForIndex']);

Route::get('/agregar-post', [PostsController::class, 'agregarPostForm'])->middleware('ifauth');

Route::post('/agregar-post', [PostsController::class, 'agregarPost'])->middleware('ifauth');

Route::get('/post-list', [PostsController::class, 'retornarPosts'])->middleware('ifauth');

Route::get('/posts/{slug}', [PostsController::class, 'returnPost']);

Route::get('/buscar-posts', [PostsController::class, 'buscarPosts']);

Route::get('/busqueda-posts', [PostsController::class, 'postsBusqueda']);

Route::get('/posts/editar-post/{slug}', [PostsController::class, 'editarPost'])->middleware('ifauth');

Route::post('/posts/editar-post/{slug}', [PostsController::class, 'modificarPost'])->middleware('ifauth');

Route::delete('/posts/eliminar-post/{slug}', [PostsController::class, 'borrarPost'])->middleware('ifauth');

Route::get('/contacto', function () {
    return view('contacto');
});

Route::post('/enviar-email', [MailController::class, 'enviarMail']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', [RegisterController::class, 'redirectFunction']);


Auth::routes();

