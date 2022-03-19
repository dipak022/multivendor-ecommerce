<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
class SellerController extends Controller
{
    public function seller(){
        $orders=Order::orderBy('id','DESC')->get();
        return view('seller.index',compact('orders'));
    }
}
