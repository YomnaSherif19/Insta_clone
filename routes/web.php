<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SavedPostController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , 'verified'])->name('dashboard');



Route ::get('/posts',[PostController::class,'index'])->name('posts.index');
Route ::get('posts/create' ,[PostController::class,'create'])->name('posts.create')
//->middleware(['auth'])
;
Route ::post('/posts',[PostController::class,'store'])->name('posts.store');
Route ::get('/posts/{id}',[PostController::class,'show'])->where('id','[0-9]+')->name('posts.show');


// Route ::post('/savedposts',[SavedPostController::class,'store'])->name('savedposts.store');
Route ::get('/savedposts',[SavedPostController::class,'index'])->name('savedposts.index');
Route ::post('/savedposts',[SavedPostController::class,'update'])->name('savedposts.update');

require __DIR__.'/auth.php';
