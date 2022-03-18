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
require __DIR__.'/frontend.php';

require __DIR__.'/backend.php';

require __DIR__.'/seller.php';

// Backend all route here 
Auth::routes(['register'=>false]);










 
