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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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


//    index page --- showing all posts
    Route::get('/', [\App\Http\Controllers\PublicController::class, 'index'])->name('public.index');
//    END-index page --- showing all posts

//    showing single post
    Route::get('/post/{slug}', [\App\Http\Controllers\PublicController::class, 'showOne'])->name('public.one');
//    END-showing single post

//    showing about page
    Route::get('/about', [\App\Http\Controllers\PublicController::class, 'about'])->name('about');
//    END-showing about page

//    showing contact page
    Route::get('/contact', [\App\Http\Controllers\PublicController::class, 'contact'])->name('contact');
//    END-showing contact page
//    sending mail from form
    Route::post('/contact', [\App\Http\Controllers\PublicController::class, 'mailer'])->name('contact.mail');
//    END-sending mail from form
