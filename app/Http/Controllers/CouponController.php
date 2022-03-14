<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Str;
use DB;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon=Coupon::orderBy('id','DESC')->get(); 
        return view('backend.coupon.index',compact('coupon'));
    }
    public function couponStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        if ($status) {
            $notification = array(
                'message' => 'Status Change Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Status Change Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        } 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $status = Coupon::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Coupon Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('coupon.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Coupon Created Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            return view('backend.coupon.edit',compact(['coupon']));
        }else{
            $notification = array(
                'message' => 'Data Not Found',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
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
        $coupon = Coupon::find($id);
        if($coupon){
            
            $data = $request->all();
            
            $status = $coupon->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'Coupon Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('coupon.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Coupon Update Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Data Not Found',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $coupon = Coupon::find($id);
        if($coupon){
            $status = $coupon->delete();
            if ($status) {
                $notification = array(
                    'message' => 'c=Coupon Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('coupon.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Coupon Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
