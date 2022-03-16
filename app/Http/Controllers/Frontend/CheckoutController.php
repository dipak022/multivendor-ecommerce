<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\Shipping;
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

    public function Checkout1Store(Request $request){
        //return $request->all();
        Session::put('checkout',[
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'address'=>$request->address,
            'city'=>$request->city,
            'street'=>$request->street,
            'postcode'=>$request->postcode,
            'note'=>$request->note,

            'sfirst_name'=>$request->sfirst_name,
            'slast_name'=>$request->slast_name,
            'semail'=>$request->semail,
            'sphone'=>$request->sphone,
            'scountry'=>$request->scountry,
            'saddress'=>$request->saddress,
            'scity'=>$request->scity,
            'sstreet'=>$request->sstreet,
            'spostcode'=>$request->spostcode,
        ]);

        $shipping = Shipping::where('status','active')->orderBy('shipping_address','ASC')->get();

        return view('frontend.pages.checkout.checkout2',compact('shipping'));

    }

    public function Checkout2Store(Request $request){
        //return $request->all();
        Session::push('checkout',[
            'delivery_charge'=>$request->delivery_charge,
        ]);

        //$shipping = Shipping::where('status','active')->orderBy('shipping_address','ASC')->get();

        return view('frontend.pages.checkout.checkout3');

    }

    public function Checkout3Store(Request $request){
        //return $request->all();
        Session::push('checkout',[
            'payment_method'=>$request->payment_method,
            'payment_status'=>"paid",
        ]);

        //return Session::get('checkout');

        return view('frontend.pages.checkout.checkout4');

    }

    

    
}
