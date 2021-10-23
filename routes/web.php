<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
// routes for  products ..........................
Route::resource('products', 'ProductController');

Route::get('products/trash/{id}', 'ProductController@softDeleted')->name('trash');

Route::get('products/get/TrashedProducts', 'ProductController@trashedProducts')->name('getTrashed');

Route::get('products/delete/ForEver/{id}', 'ProductController@deleteForEver')->name('deleteForEver');

Route::get('products/restore/trashed/{id}', 'ProductController@restoreTrashed')->name('restoreTrashed');

// routes for Posts .....................................................

Route::resource('posts', 'PostController');
Route::get('posts/trash/{id}', 'PostController@softDelete')->name('post.trash');
Route::get('posts/get/trashedPosts', 'PostController@trashedPost')->name('post.getTrashed');
Route::get('posts/restore/trashed/{id}', 'PostController@restoreTrashed')->name('post.restoreTrashed');
Route::get('posts/delete/trashed/{id}', 'PostController@deleteForEver')->name('post.deleteForEver');

Route::resource('comments', 'CommentController');

// routes for authentication .....................................
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
