<?php


// seller Deshboard


Route::group(['prefix'=>'seller'],function(){

    Route::get('/login', [App\Http\Controllers\Auth\Seller\AuthController::class, 'ShowLoginForm'])->name('seller.login.form');
    Route::post('/login', [App\Http\Controllers\Auth\Seller\AuthController::class, 'login'])->name('seller.login');
}); 




Route::group(['prefix'=>'seller','middleware'=>['seller']],function(){

    Route::get('/', [App\Http\Controllers\SellerController::class, 'seller'])->name('seller');

    //Product  route here
    Route::resource('/seller_product', App\Http\Controllers\Seller\ProductController::class);
    Route::post('/seller_product_status', [App\Http\Controllers\Seller\ProductController::class, 'SellerProductStatus'])->name('seller.product.status');

});



    
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:seller']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
