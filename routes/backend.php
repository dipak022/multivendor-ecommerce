
<?php



Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){

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

//product.attribute
Route::post('product-attribute/{id}', [App\Http\Controllers\ProductController::class, 'AddProductAttribute'])->name('product.attribute');
Route::delete('product-destroy/{id}', [App\Http\Controllers\ProductController::class, 'AddProductAttributeDestroy'])->name('product.attribute.destroy');

//Route::delete('product-destroy/{id}', [App\Http\Controllers\ProductController::class, 'AddProductAttributeDestroy'])->name('product.attribute.destroy');




//user route here 
Route::resource('/user', App\Http\Controllers\UserController::class);
Route::post('/user_status', [App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');

//coupon route here 
Route::resource('/coupon', App\Http\Controllers\CouponController::class);
Route::post('/coupon_status', [App\Http\Controllers\CouponController::class, 'couponStatus'])->name('coupon.status');


 //shipping route here 
 Route::resource('/shipping', App\Http\Controllers\ShippingController::class);
 Route::post('/shipping_status', [App\Http\Controllers\ShippingController::class, 'ShippingsStatus'])->name('shipping.status');


 //Order Route here 
 Route::resource('/order', App\Http\Controllers\OrderController::class);

 //order.status
 Route::post('order/status/', [App\Http\Controllers\OrderController::class, 'OrderStatus'])->name('order.status');

 //seeting
 Route::get('seeting', [App\Http\Controllers\SettingController::class, 'Seeting'])->name('seeting');
 Route::post('update/seeting/{id}', [App\Http\Controllers\SettingController::class, 'SeetingUpdate'])->name('seeting.update');


  //Seller account verified
  Route::resource('seller', App\Http\Controllers\BackendSellerController::class);
  Route::post('/seller_status', [App\Http\Controllers\BackendSellerController::class, 'SellerStatus'])->name('seller.status');
  Route::post('/is_verified_status', [App\Http\Controllers\BackendSellerController::class, 'is_verifiedSellerStatus'])->name('is_verified.seller.status');






});



// admin Deshboard
Route::group(['prefix'=>'admin'],function(){

    Route::get('/login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'ShowLoginForm'])->name('admin.login.form');
    Route::post('/login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login'])->name('admin.login');
}); 



Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
