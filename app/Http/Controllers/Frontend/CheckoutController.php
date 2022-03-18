<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OredrMail;
use Response;
use Cart;
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
            'sub_total'=> $request->sub_total,
            //'quantity'=>$request->quantity,
            'total_amount'=>$request->total_amount,
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
            'payment_status'=>"unpaid",
        ]);

        //return Session::get('checkout');

        return view('frontend.pages.checkout.checkout4');

    }

    public function CheckoutStore(){
        
        $order = new Order();
        $order['user_id'] =auth()->user()->id;
        $order['order_number'] =Str::upper('ORD-'.Str::random(8));
        //return Session::get('checkout');
        
        if(Session::has('coupon')){
            $order['coupon'] =Session::get('coupon')['value'];
        }else{
            $order['coupon'] =0;
        }
        $order['sub_total'] =Session::get('checkout')['sub_total'];
        $order['total_amount'] =number_format((float) str_replace(',','',Session::get('checkout')['total_amount'])+ + ((float)Session::get('checkout')[0]['delivery_charge']) -((float) $order['coupon']),2);
        //number_format((float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) - session('coupon')['value'],2)
        //$order['charge']=number_format((float) str_replace(',','',Session::get('checkout')['total_amount']),2)+(());
        //$order['total_amount'] =((float)Session::get('checkout')['total_amount']) + ((float)$order['charge']) ;
        //return $order;
        $order['payment_method'] =Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] =Session::get('checkout')[1]['payment_status'];
        $order['condition'] ='pending';
        $order['delivery_charge'] =Session::get('checkout')[0]['delivery_charge'];
        $order['first_name'] =Session::get('checkout')['first_name'];
        $order['last_name'] =Session::get('checkout')['last_name'];
        $order['email'] =Session::get('checkout')['email'];
        $order['phone'] =Session::get('checkout')['phone'];
        $order['country'] =Session::get('checkout')['country'];
        $order['address'] =Session::get('checkout')['address'];
        $order['city'] =Session::get('checkout')['city'];
        $order['street'] =Session::get('checkout')['street'];
        $order['postcode'] =Session::get('checkout')['postcode'];
        $order['note'] =Session::get('checkout')['note'];

        $order['sfirst_name'] =Session::get('checkout')['sfirst_name'];
        $order['slast_name'] =Session::get('checkout')['slast_name'];
        $order['semail'] =Session::get('checkout')['semail'];
        $order['sphone'] =Session::get('checkout')['sphone'];
        $order['scountry'] =Session::get('checkout')['scountry'];
        $order['saddress'] =Session::get('checkout')['saddress'];
        $order['scity'] =Session::get('checkout')['scity'];
        $order['sstreet'] =Session::get('checkout')['sstreet'];
        $order['spostcode'] =Session::get('checkout')['spostcode'];
        

        $status = $order->save();
        
        foreach( Cart::instance('shopping')->content() as $item){
            $product_id[]=$item->id;
            $product = Product::find($item->id);
            $quantity=$item->qty;
            $order->products()->attach($product,['quantity'=>$quantity]);
        }



        if($status){
            Mail::to($order['email'])->bcc($order['semail'])->cc('dipakdebnath4022@mail.com')->send(new OredrMail($order));
            //dd('Mail is send');
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            $notification = array(
                'message' => 'Order Complete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('complete',$order['order_number'])->with($notification);
        }else{
            $notification = array(
                'message' => 'Order Complete Unsuccessfully',
                'alert-type' => 'error'
            );
            return redirect()->route('checkout1')->with($notification);
        }


    }

    public function Complete($order){
        $order = $order;
        return view('frontend.pages.checkout.complate',compact('order'));
    }

    

    
}
