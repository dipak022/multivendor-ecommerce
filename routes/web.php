<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
//Route::get('/', function () {
 //   return view('welcome');
//});
*/

// Frontend route strat 
Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('home');

//product category
Route::get('product-category/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'ProductCategory'])->name('product.category');

//product.detail
Route::get('product-detail/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'ProductDetail'])->name('product.detail');


// Frontend route end


//authantication route
Route::get('user/auth/', [App\Http\Controllers\Frontend\IndexController::class, 'UserAuth'])->name('user.auth');


// Backend all route here 
Auth::routes(['register'=>false]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Admin Deshboard
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    
    // Banner route here 
    Route::resource('/banner', App\Http\Controllers\BannerController::class);
    Route::post('/banner_status', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    //category route here 
    Route::resource('/category', App\Http\Controllers\CategoryController::class);
    Route::post('/category_status', [App\Http\Controllers\CategoryController::class, 'CategoryStatus'])->name('category.status');

    //brand route here 
    Route::resource('/brand', App\Http\Controllers\BrandController::class);
    Route::post('/brand_status', [App\Http\Controllers\BrandController::class, 'BrandStatus'])->name('brand.status');

    //Product  route here
    Route::resource('/product', App\Http\Controllers\ProductController::class);
    Route::post('/product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');
    Route::post('category/{id}/child', [App\Http\Controllers\CategoryController::class, 'getChildByParentId']);

    //user route here 
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::post('/user_status', [App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');






});



// seller Deshboard
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'seller'])->name('seller');
});    
