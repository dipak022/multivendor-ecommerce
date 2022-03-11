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

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Admin Deshboard
Route::group(['prefix'=>'admin/','middleware'=>'auth'],function(){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    
    // Banner route here 
    Route::resource('/banner', App\Http\Controllers\BannerController::class);
    Route::post('/banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    //category route here 
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
    Route::post('/category_status', [App\Http\Controllers\CategoryController::class, 'CategoryStatus'])->name('category.status');






});
