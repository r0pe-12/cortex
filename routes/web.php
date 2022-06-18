<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// todo add (middleware for admin) as well as policies
Route::middleware(['auth'])->prefix('admin')->group( function (){

//    route for admin home page
   Route::get('/', function (){return view('admin.index');})->name('admin.index') ;
//   end-route for home page

//    routes for managing posts on admin side
    Route::resource('/posts', App\Http\Controllers\AdminPostsController::class, ['as'=>'admin']);
    Route::post('/postpic/destroy/{post_id}', [\App\Http\Controllers\AdminPostsController::class, 'destroyPicture'])->name('admin.posts.picture.destroy');
//    end-routes for managing posts on admin side

//    routes for managing users on admin side
    Route::resource('/users', \App\Http\Controllers\AdminUsersController::class, ['as'=>'admin',  'except'=>'show']);
    Route::get('/users/{user}/posts', [\App\Http\Controllers\AdminUsersController::class, 'showPosts'])->name('admin.users.posts');
    Route::post('/userpic/destroy/{user_id}', [\App\Http\Controllers\AdminUsersController::class, 'destroyPicture'])->name('admin.users.picture.destroy');
//    END-routes for managing users on admin side


});
