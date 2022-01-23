<?php

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\UserController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\LiveSearch\PostController;

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
// Route::get('/', [CategoryController::class, 'category']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'category']);

//Route::view('/categories', 'categories.index');
Route::get('/get_causes_against_category/{id}', [CategoryController::class, 'get_causes_against_category']);


/*************************users part***************************** */
// Route::prefix('users')->group(function () {
    Route::get('/allUsers', [UserController::class , 'index']);

        Route::resource('users', UserController::class)->except(['update','destroy']);

        Route::put('users/{id}', [UserController::class , 'update'])->name('users.update');
        Route::get('users_delete/{id}', [UserController::class , 'destroy']);

// });


/*******************the second example ( the filter example )************************************ */
Route::prefix('admin')->name('admin.')->group(function () {
    // example:
    // Route::get('/categories', function () {
           // Matches The "/admin/users" URL
    //     // Route assigned name "admin.categories"...
    // })->name('categories');

    Route::get('live_search_page', [PostController::class , 'showLiveSearchPage']);
    Route::get('search', [PostController::class , 'showList']);




});