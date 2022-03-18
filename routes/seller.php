<?php


// seller Deshboard
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){

    Route::get('/', [App\Http\Controllers\AdminController::class, 'seller'])->name('seller');
});    
