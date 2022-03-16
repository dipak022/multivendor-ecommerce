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

//cart route here
Route::get('cart', [App\Http\Controllers\Frontend\CartController::class, 'Cart'])->name('cart');
Route::post('cart/store', [App\Http\Controllers\Frontend\CartController::class, 'CartStore'])->name('cart.store');
Route::post('cart/delete', [App\Http\Controllers\Frontend\CartController::class, 'CartDelete'])->name('cart.delete');
Route::post('cart/update', [App\Http\Controllers\Frontend\CartController::class, 'CartUpdate'])->name('cart.update');



//coupon.add
Route::post('coupon/add/', [App\Http\Controllers\Frontend\CartController::class, 'couponAdd'])->name('coupon.add');

//Wishlist 
Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'Wishlist'])->name('wishlist');
Route::post('wishlist/store/', [App\Http\Controllers\Frontend\WishlistController::class, 'StoreWishlist'])->name('wishlist.store');
//wishlist.move.cart
Route::post('wishlist/move/cart/', [App\Http\Controllers\Frontend\WishlistController::class, 'WishlistMoveCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete/', [App\Http\Controllers\Frontend\WishlistController::class, 'WishlistDelete'])->name('wishlist.delete');


//checkout route 
Route::get('checkout1', [App\Http\Controllers\Frontend\CheckoutController::class, 'Checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first/', [App\Http\Controllers\Frontend\CheckoutController::class, 'Checkout1Store'])->name('checkout1.store');
Route::post('checkout-second/', [App\Http\Controllers\Frontend\CheckoutController::class, 'Checkout2Store'])->name('checkout2.store');
Route::post('checkout-three/', [App\Http\Controllers\Frontend\CheckoutController::class, 'Checkout3Store'])->name('checkout3.store');
Route::get('checkout-store', [App\Http\Controllers\Frontend\CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
Route::get('complete/{order}', [App\Http\Controllers\Frontend\CheckoutController::class, 'Complete'])->name('complete');


//shop
Route::get('shop', [App\Http\Controllers\Frontend\IndexController::class, 'Shop'])->name('shop');
Route::post('shop-filter', [App\Http\Controllers\Frontend\IndexController::class, 'ShopFilter'])->name('shop.filter');




// Frontend route end



//authantication route
Route::get('user/auth/', [App\Http\Controllers\Frontend\IndexController::class, 'UserAuth'])->name('user.auth');
Route::post('user/login/', [App\Http\Controllers\Frontend\IndexController::class, 'LoginSubmit'])->name('login.submit');
Route::post('user/register/', [App\Http\Controllers\Frontend\IndexController::class, 'registerSubmit'])->name('register.submit');
Route::get('user/logout/', [App\Http\Controllers\Frontend\IndexController::class, 'UserLogout'])->name('user.logout');





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

    //coupon route here 
    Route::resource('/coupon', App\Http\Controllers\CouponController::class);
    Route::post('/coupon_status', [App\Http\Controllers\CouponController::class, 'couponStatus'])->name('coupon.status');


     //shipping route here 
     Route::resource('/shipping', App\Http\Controllers\ShippingController::class);
     Route::post('/shipping_status', [App\Http\Controllers\ShippingController::class, 'ShippingsStatus'])->name('shipping.status');






});



// seller Deshboard
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'seller'])->name('seller');
});    


//user dashboard 
Route::group(['prefix'=>'user'],function(){

    Route::get('/dashboard', [App\Http\Controllers\Frontend\IndexController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/order', [App\Http\Controllers\Frontend\IndexController::class, 'UserOrder'])->name('user.order');
    Route::get('/address', [App\Http\Controllers\Frontend\IndexController::class, 'UserAddress'])->name('user.address');
    Route::get('/account-detail', [App\Http\Controllers\Frontend\IndexController::class, 'UserAccountDetails'])->name('user.account.detail');
    Route::post('/billing/address/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'BillingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'ShippingAddress'])->name('shipping.address');
    Route::post('/account/update/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'AccountUpdate'])->name('account.update');
});  
