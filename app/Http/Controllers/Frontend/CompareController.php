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
class CompareController extends Controller
{
    public function compare(){
        return view('frontend.pages.compare.compare');
    }

    public function StoreCompareWishlist(Request $request){
        //return $request->all();
        $product_id =$request->input('product_id');
        $product=Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];
        $compare_array=[];
        foreach(Cart::instance('compare')->content() as $item){
            $compare_array[]=$item->id;
        }
        if(in_array($product_id,$compare_array)){
            $response['present']=true;
            $response['message']="Item is already your Compare";
        }elseif(count($compare_array)>=4){
            $response['status']=false;
            $response['message']="You can't add more than 4 items";
        }elseif($product[0]['strock']<=0){
            $response['status']=false;
            $response['message']="We don't have enough items";
        }
        else{
            $result= Cart::instance('compare')->add($product_id,$product[0]['title'],1,$price)->associate('App\Models\Product');
            if($result){
                $response['status']=true;
                $response['compaer_count']=Cart::instance('compare')->count(); 
                $response['message']="Item has been save in compare list";

            }
        }
        return json_encode($response);

    }

    public function compareMoveCart(Request $request){
        //return $request->all();
        $item = Cart::instance('compare')->get( $request->input('rowId'));
        //dd($item);
        Cart::instance('compare')->remove($request->input('rowId'));
        $result= Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            
            $response['status']=true;
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Item has been Move Cart";

        }
        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $wishlist_list = view('frontend.layouts.wishlist')->render();
            $wishlist_list = view('frontend.layouts.wishlist')->render();
            $response['header']=$header;
            $response['compare_list']=$compare;
            $response['wishlist_list']=$wishlist_list;
        }
        return $response;
    }


    public function compareMoveWishlist(Request $request){
        //return $request->all();
        $item = Cart::instance('compare')->get( $request->input('rowId'));
        //dd($item);
        Cart::instance('compare')->remove($request->input('rowId'));
        $result= Cart::instance('wishlist')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        if($result){
            
            $response['status']=true;
            //$response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Item has been Move Wishlist";

        }
        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $wishlist_list = view('frontend.layouts.wishlist')->render();
            $wishlist_list = view('frontend.layouts.wishlist')->render();
            $response['header']=$header;
            $response['compare_list']=$compare;
            $response['wishlist_list']=$wishlist_list;
            
        }
        return $response;
    }

    public function compareDelete(Request $request){
        $id = $request->input('rowId');
        $result = Cart::instance('compare')->remove($id);
        $response['status']=true;
        $response['cart_count']=Cart::instance('shopping')->count();
        $response['message']="Item has beensuccessfully remove form your wishlist";

        if($request->ajax()){
            $header = view('frontend.layouts.header')->render();
            $wishlist_list = view('frontend.layouts.wishlist')->render();
            $compare = view('frontend.layouts.compare')->render();
            $response['header']=$header;
            $response['wishlist_list']=$wishlist_list;
            $response['compare_list']=$compare;
        }
        return $response;
    }
}
