<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//use Session;
use DB;
class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $categorys = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        return view('frontend.index',compact(['banners','categorys']));
    }

    public function ProductCategory($slug){
        //return $slug;
        $categorys = Category::with('products')->where('slug',$slug)->first();
        return view('frontend.pages.product.product-category',compact(['categorys']));

    }

    public function ProductDetail($slug){
        $products = Product::with('rel_prods')->where('slug',$slug)->first();
        if($products){
            return view('frontend.pages.product.product-detail',compact(['products']));
        }else{
            $notification = array(
                'message' => 'Product not found.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
           
        }
        
    }

    public function UserAuth(){
        return view('frontend.auth.auth');
    }

    public function LoginSubmit(Request $request){
        //return $request->all();
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active'])){
            Session::put('user',$request->email);
            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }else{
               
                $notification = array(
                    'message' => 'Successfully Login',
                    'alert-type' => 'success'
                );
                return redirect()->route('home')->with($notification);
            }
            
        }else{
            $notification = array(
                'message' => 'Invalid Email & Password',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    }
}
