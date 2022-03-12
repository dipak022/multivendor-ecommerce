<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::orderBy('id','DESC')->get(); 
        return view('backend.products.index',compact('product'));
    }

    public function productStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.products.create');
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
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug .= time().'_'.$slug;
        }
        $data['slug']= $slug;
        $data['offer_price'] = $request->price-(($request->price*$request->discount)/100);
        //return $data;
        $status = Product::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Product Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('product.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Product Created Unuccessfully',
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
        $product = Product::find($id);
        if($product){
            return view('backend.products.index',compact('product'));
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
        $product = Product::find($id);
        //$parant_category = Product::where('is_parent',1)->orderBy('title','ASC')->get();
        if($product){
            return view('backend.products.edit',compact(['product']));
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
        $product = Product::find($id);
        if($product){
            $data = $request->all();
            $data['offer_price'] = $request->price-(($request->price*$request->discount)/100);
            $status = $product->fill($data)->save();
            if ($status) {
                $notification = array(
                    'message' => 'Product Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('product.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Product Update Unuccessfully',
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
        $product = Product::find($id);
        if($product){
            $status = $product->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Product Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('product.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Product Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
