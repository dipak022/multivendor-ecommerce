<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//use Session;
//use App\Url;
use Redirect;
use URL;
use DB; 
class CheckoutController extends Controller
{
    
    public function Checkout1(){
        $user =Auth::user();
        return view('frontend.pages.checkout.checkout1',compact('user'));
    }
}
