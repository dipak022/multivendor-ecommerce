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
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Response;
use Cart;
//use Session;
use DB;

class CartController extends Controller
{
    public function Cart(){
        return view('frontend.pages.cart.index');
    }
    public function CartStore(Request $request){
        //dd($request->all());
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        //return $product;
        $price = $product[0]['offer_price'];
        //dd($price);
        $cart_array=[];
        foreach(Cart::instance('shopping')->content() as $item){
            $cart_array[]=$item->id; 
        }
        $result = Cart::instance('shopping')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
        if($result){
            $response['status']=true;
            $response['product_id']=$product_id;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count(); 
            $response['message']="Item was added to your cart";

        }
        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $response['header']=$header;
        }
        return json_encode($response);
    }

    public function CartDelete(Request $request){
        $id = $request->input('cart_id');
        $result = Cart::instance('shopping')->remove($id);
        $response['status']=true;
        $response['message']="Cart item successfully remove";
        $response['total']=Cart::subtotal();
        $response['cart_count']=Cart::instance('shopping')->count(); 
        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $response['header']=$header;
        }
        return json_encode($response);

    }

    
}
