<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
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
        $product=Product::where(['added_by'=>'seller','user_id'=>auth('seller')->user()->id])->orderBy('id','DESC')->get(); 
        return view('seller.products.index',compact('product'));
    }
    public function SellerProductStatus(Request $request){
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
        return view('seller.products.create');
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
        $data['user_id']= auth('seller')->user()->id;
        //dd($data);
        $data['added_by']='seller';
        $data['offer_price'] = $request->price-(($request->price*$request->discount)/100);
        //return $data;
        $status = Product::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Product Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('seller_product.index')->with($notification);
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
        $productattr=ProductAttribute::where('product_id',$id)->get();
        if($product){
            return view('backend.products.product-attribute',compact('product','productattr'));
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
            return view('seller.products.edit',compact(['product']));
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
            $data['user_id']= auth('seller')->user()->id;

           dd($data);
            $data['added_by']='seller';
            $data['offer_price'] = $request->price-(($request->price*$request->discount)/100);
            $status = $product->fill($data)->save();
            if ($status) {
                $notification = array(
                    'message' => 'Product Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('seller_product.index')->with($notification);
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
                return redirect()->route('seller_product.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Product Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    //AddProductAttribute
    public function AddProductAttribute(Request $request, $id){
        //return $request->all();
        $data= $request->all();
        foreach($data['original_price'] as $key=>$val){
            if(!empty($val)){
                $attribute = new ProductAttribute;
                $attribute['original_price']=$val;
                $attribute['offer_price']=$data['offer_price'][$key];
                $attribute['stock']=$data['stock'][$key];
                $attribute['product_id']=$id;
                $attribute['size']=$data['size'][$key];
                $attribute->save();
            }
        }
        $notification = array(
            'message' => 'Product attribute add Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function AddProductAttributeDestroy($id){
        $productattribute = ProductAttribute::find($id);
        if($productattribute){
            $status = $productattribute->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Product Attribute Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('product.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Product Attribute Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }

    }
}
