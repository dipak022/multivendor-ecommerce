<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Support\Str;
use DB;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping=Shipping::orderBy('id','DESC')->get(); 
        return view('backend.shipping.index',compact('shipping'));
    }

    public function ShippingsStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('shippings')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('shippings')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $data = $request->all();
        $status = Shipping::create($data);

        if ($status) {
            $notification = array(
                'message' => 'shipping Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('shipping.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Shipping Created Unuccessfully',
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
        $shipping = Shipping::find($id);
        if($shipping){
            return view('backend.shipping.edit',compact('shipping'));
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
        $shipping = Shipping::find($id);
        if($shipping){
           
            $data = $request->all();
            
            $status = $shipping->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'Shipping Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('shipping.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Shipping Update Unuccessfully',
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
        $shipping = Shipping::find($id);
        if($shipping){
            $status = $shipping->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Shipping Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('shipping.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Shipping Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
