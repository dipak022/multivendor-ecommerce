<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductOrder;
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
class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $promo_banner = Banner::where(['status'=>'active','condition'=>'promo'])->orderBy('id','DESC')->first();
        $categorys = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        $new_products = Product::where(['status'=>'active','conditions'=>'new'])->orderBy('id','DESC')->limit('12')->get();
        $featured_products =Product::where(['status'=>'active','is_featured'=>1])->orderBy('id','DESC')->limit('12')->get();
        $brands =Brand::where(['status'=>'active'])->orderBy('id','DESC')->get();
        //top sell
        $items = DB::table('product_orders')->select('product_id',DB::raw('COUNT(product_id) as count'))->groupBy('product_id')->orderBy('count','DESC')->get();
        $product_ids=[];
        foreach($items as $item){
            array_push($product_ids,$item->product_id);
        }
        $best_sellings = Product::whereIn('id',$product_ids)->get();
        //return $best_selling;
        // best reting
        $item_rateds = DB::table('product_reviews')->select('product_id',DB::raw('AVG(rate) as count'))->groupBy('product_id')->orderBy('count','DESC')->get();
        $product_ids=[];
        foreach($item_rateds as $item_rated){
            array_push($product_ids,$item->product_id);
        }
        $best_rateds = Product::whereIn('id',$product_ids)->get();
        //return $best_selling;

        return view('frontend.index',compact(['banners','categorys','new_products','featured_products','promo_banner','brands','best_sellings','best_rateds']));
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
        Session::put('url.intended',URL::previous());
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
                'alert-type' => 'error'
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
                'alert-type' => 'error'
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
        $user = User::where('id',$id)->update(['country'=>$request->country,'city'=>$request->city,'state'=>$request->state,'postcode'=>$request->postcode,'address'=>$request->address]);
        if($user){
            $notification = array(
                'message' => 'Address Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Address Update Unsuccessfully',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
    }

    public function ShippingAddress(Request $request,$id){
        //return $request->all();
        $user = User::where('id',$id)->update(['scountry'=>$request->scountry,'scity'=>$request->scity,'sstate'=>$request->sstate,'spostcode'=>$request->spostcode,'saddress'=>$request->saddress]);
        if($user){
            $notification = array(
                'message' => 'Shipping Address Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Shipping Address Update Unsuccessfully',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
    }

    public function AccountUpdate(Request $request,$id){
        $hashpassword = Auth::user()->password;
        //return $hashpassword;
        if($request->oldpassword == null && $request->newpassword == null){
            $user = User::where('id',$id)->update(['full_name'=>$request->full_name,'username'=>$request->username,'phone'=>$request->phone]);
            if($user){
                $notification = array(
                    'message' => 'Account Information Update Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Account Information Update Unsuccessfully',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            if(\Hash::check($request->oldpassword,$hashpassword)){
                if(!\Hash::check($request->newpassword,$hashpassword)){
                    $user = User::where('id',$id)->update(['full_name'=>$request->full_name,'username'=>$request->username,'phone'=>$request->phone,'password'=>Hash::make($request->newpassword)]);
                    if($user){
                        $notification = array(
                            'message' => 'Account Information and password Update Successfully',
                            'alert-type' => 'success'
                        );
                        return redirect()->back()->with($notification);
                    }else{
                        $notification = array(
                            'message' => 'Account Information and password Update Unsuccessfully',
                            'alert-type' => 'error'
                        );
                        return redirect()->back()->with($notification);
                    }
                }else{
                    $notification = array(
                        'message' => 'New Password can not be same with old password !! try Again',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }

            }else{
                $notification = array(
                    'message' => 'Old password dose not match !! try Again! ',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }
        
        
    }


    public function Shop(){

        $products =Product::query();

        //category 
        if(!empty($_GET['category'])){
            $slugs=explode(',',$_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            //return $cat_ids;
            $products =$products->whereIn('cat_id',$cat_ids)->paginate(12);
            //return $products;
        }
        //brand 
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products =$products->whereIn('brand_id',$brand_ids)->paginate(12);
            
        }
        if(!empty($_GET['sortBy'])){
            $sort=$_GET['sortBy'];
            if($sort=="priceAsc"){
                $products = $products->where(['status'=>'active'])->orderBy('offer_price','ASC')->paginate(12);
            }if($sort=="priceDesc"){
                $products = $products->where(['status'=>'active'])->orderBy('offer_price','DESC')->paginate(12);
            }if($sort=="discAsc"){
                $products = $products->where(['status'=>'active'])->orderBy('price','ASC')->paginate(12);
            }if($sort=="discDesc"){
                $products = $products->where(['status'=>'active'])->orderBy('price','DESC')->paginate(12);
            }if($sort=="titelAsc"){
                $products = $products->where(['status'=>'active'])->orderBy('title','ASC')->paginate(12);
            }if($sort=="titelDesc"){
                $products = $products->where(['status'=>'active'])->orderBy('title','DESC')->paginate(12);
            }
        }
        else{
            $products = $products->where('status','active')->paginate(12);
        }
        $brands=Brand::where(['status'=>'active'])->with('products')->orderBy('title','ASC')->get();
        $cats=Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        //return $products;
        return view('frontend.pages.product.shop',compact('products','cats','brands'));
    }

    public function ShopFilter(Request $request){
        //dd($request->all());
        //category filter
        $data = $request->all();
        $catUrl ='';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl .='&category='.$category;
                }else{
                    $catUrl .=','.$category;
                }
            }
        }
        //sort filter
        $sortByUrl="";
        if(!empty($data['sortBy'])){
            $sortByUrl .="&sortBy=".$data['sortBy'];
        }
        //price filter
        $price_range_Url= "";
        if(!empty($data['price_range'])){
            $price_range_Url .="&price=".$data['price_range'];
        }
        // brand filter
        

        $brandUrl ='';
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandUrl)){
                    $brandUrl .='&brand='.$brand;
                }else{
                    $brandUrl .=','.$brand;
                }
            }
        }
        return \redirect()->route('shop', $catUrl.$sortByUrl.$brandUrl);



    }


    public function AutoSearch(Request $request){
        $quary = $request->get('term','');
        //dd($quary);
        $products= Product::where('title','LIKE','%'.$quary.'%')->get();
        $data =array();
        foreach($products as $product){
            $data[]=array('value'=>$product->title,'id'=>$product->id);
        }
        return $data;
        if(count($data)){
            return $data;
        }else{
            return ['value'=>"Not Result Found.",'id'=>''];
        }

    }

    public function search(Request $request){
        $quary = $request->input('query');
        $products= Product::where('title','LIKE','%'.$quary.'%')->orderBy('id','DESC')->paginate(12);
        $brands=Brand::where(['status'=>'active'])->with('products')->orderBy('title','ASC')->get();
        $cats=Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats','brands'));


    }

    

    

    

    

}
