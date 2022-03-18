<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderBy('id','DESC')->get();
        return view('backend.order.index',compact('orders'));
    }
    public function OrderStatus(Request $request)
    {
       
       //$check= $request->input('order_id');
       //return $check;\
       $order =Order::find($request->input('order_id'));
       if($order){
           if($request->input('condition')=='delivered'){
               foreach($order->products as $item){
                   $product = Product::where('id',$item->pivot->product_id)->first();
                   //dd($product);
                   $stock=$product->strock;
                   $stock -=$item->pivot->quantity;
                   $product->update(['strock'=>$stock]);
                   Order::where('id',$request->input('order_id'))->update(['payment_status'=>'paid']);
               }
           }
           $status =Order::where('id',($request->input('order_id')))->update(['condition'=>$request->input('condition')]);
           if($status){
                $notification = array(
                    'message' => 'Order Update Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
           }else{
                $notification = array(
                    'message' => 'Order Update Successfully',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);

           }
       }
       abort(404);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if($order){
            return view('backend.order.show',compact('order'));
        }else{
            $notification = array(
                'message' => 'Data Not Found',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order){
            $status = $order->delete();
            if ($status) {
                $notification = array(
                    'message' => 'order Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('order.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'order Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
