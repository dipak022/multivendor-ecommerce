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
use DB;
class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $categorys = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        return view('frontend.index',compact(['banners','categorys']));
    }

    public function ProductCategory(Request $request,$slug){
        //return $slug;
        $categorys = Category::with('products')->where('slug',$slug)->first();
        $sort = '';
        if($request->sort != null){
            $sort =$request->sort;

        }
        if($categorys == null){
            return view('errors.404');
        }else{
            if($sort=="priceAsc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('offer_price','ASC')->paginate(12);
            }elseif($sort=="priceDesc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('offer_price','DESC')->paginate(12);
            }elseif($sort=="discAsc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('price','ASC')->paginate(12);
            }elseif($sort=="discDesc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('price','DESC')->paginate(12);
            }elseif($sort=="titelAsc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('title','ASC')->paginate(12);
            }elseif($sort=="titelDesc"){
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->orderBy('title','DESC')->paginate(12);
            }else{
                $products = Product::where(['status'=>'active','cat_id'=>$categorys->id])->paginate(12);
            }
        }
        $route = 'product-category';
        if($request->ajax()){
            $view = view('frontend.layouts.single-product',compact(['products']))->render();
            return response()->json(['html'=>$view]);
        }
        return view('frontend.pages.product.product-category',compact(['categorys','route','products']));

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

    public function registerSubmit(Request $request){
        $data = $request->all();
        $check = $this->create($data);
        Session::put('user', $data['email']);
        Auth::login($check);
        if($check){
            $notification = array(
                'message' => 'Registation Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('home')->with($notification);
        }else{
            $notification = array(
                'message' => 'Please check your Credentials',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    private function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function UserLogout(){
        Session::forget('user');
        Auth::logout();
        $notification = array(
            'message' => 'Successfully Logout',
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);
    }

    //user UserDashboard
    public function UserDashboard(){
        $user = Auth::user();
        return view('frontend.user.dashboard',compact('user'));
    }

    public function UserOrder(){
        $user = Auth::user();
        return view('frontend.user.order',compact('user'));
    }

    public function UserAddress(){
        $user = Auth::user();
        return view('frontend.user.address',compact('user'));
    }

    public function UserAccountDetails(){
        $user = Auth::user();
        return view('frontend.user.account-details',compact('user'));
    }

    public function BillingAddress(Request $request,$id){
        //return $request->all();
        return $id;

    }

    

    

}
