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
use DB;
use Response;
use Cart;
class WishlistController extends Controller
{
    public function Wishlist(){
        return view('frontend.pages.wishlist.wishlist');
    }

    public function StoreWishlist(Request $request){
        //return $request->all();
        $product_id =$request->input('product_id');
        $product_qty =$request->input('product_qty');
        $product=Product::getProductByCart($product_id);
        //dd($product);
        $price = $product[0]['offer_price'];
        $wishlist_array=[];
        foreach(Cart::instance('wishlist')->content() as $item){
            $wishlist_array[]=$item->id;
        }
        if(in_array($product_id,$wishlist_array)){
            $response['present']=true;
            $response['message']="Item is already your wishlist";
        }else{
            $result= Cart::instance('wishlist')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
            if($result){
                $response['status']=true;
                $response['wishlist_count']=Cart::instance('wishlist')->count(); 
                $response['message']="Item has been save wishlist";

            }
        }
        return json_encode($response);

    }
}
