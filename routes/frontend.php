<?php

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


//Compare  
Route::get('compare', [App\Http\Controllers\Frontend\CompareController::class, 'compare'])->name('compare');
Route::post('compare/store/', [App\Http\Controllers\Frontend\CompareController::class, 'StoreCompareWishlist'])->name('compare.store');
Route::post('compare/move/cart/', [App\Http\Controllers\Frontend\CompareController::class, 'compareMoveCart'])->name('compare.move.cart');
Route::post('compare/move/wishlist/', [App\Http\Controllers\Frontend\CompareController::class, 'compareMoveWishlist'])->name('compare.move.wishlist');
Route::post('compare/delete/', [App\Http\Controllers\Frontend\CompareController::class, 'compareDelete'])->name('compare.delete');


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

//search product and autosearch
Route::get('autosearch', [App\Http\Controllers\Frontend\IndexController::class, 'AutoSearch'])->name('autosearch');
Route::get('search', [App\Http\Controllers\Frontend\IndexController::class, 'search'])->name('search');

//product.review
Route::post('product-review/{slug}', [App\Http\Controllers\ProductReviewController::class, 'productReview'])->name('product.review');


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



//authantication route
Route::get('user/auth/', [App\Http\Controllers\Frontend\IndexController::class, 'UserAuth'])->name('user.auth');
Route::post('user/login/', [App\Http\Controllers\Frontend\IndexController::class, 'LoginSubmit'])->name('login.submit');
Route::post('user/register/', [App\Http\Controllers\Frontend\IndexController::class, 'registerSubmit'])->name('register.submit');
Route::get('user/logout/', [App\Http\Controllers\Frontend\IndexController::class, 'UserLogout'])->name('user.logout');