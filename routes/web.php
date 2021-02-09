<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
Auth::routes();
Route::get('/', [PagesController::class,'index']);
Route::get('/about', [PagesController::class,'about']);
Route::get('/services', [PagesController::class,'services']);

Route::get('/profil',  [App\Http\Controllers\UserController::class, 'profil'])->name('profil');
Route::post('/profil', [App\Http\Controllers\UserController::class, 'edit_profil'])->name('edit_profil');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']);
Route::resources([
    'posts' => PostsController::class,
]);
Route::post('','App\Http\Controllers\PostsController@store')->name('posts.store');
Route::post('/rating/{post}', 'App\Http\Controllers\PostsController@postStar')->name('postStar');
// Route::post('/rating/{post}', 'App\Http\Controllers\PostsController@up')->name('up');
// Route::post('/rating/{post}', 'App\Http\Controllers\PostsController@down')->name('down');
Route::post('/rating/{posts}', [
    'uses' => 'App\Http\Controllers\PostsController@up'
  ]);
Route::post('/posts', 'App\Http\Controllers\PostsController@index')->name('posts.index');
Route::get('/search', 'App\Http\Controllers\PostsController@search')->name('search');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
