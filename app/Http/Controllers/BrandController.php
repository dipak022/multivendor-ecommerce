<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand=Brand::orderBy('id','DESC')->get(); 
        return view('backend.brands.index',compact('brand'));
    }

    public function BrandStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.brands.create');
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
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug .= time().'_'.$slug;
        }
        $data['slug']= $slug;
        $status = Brand::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Brand Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('brand.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Brand Created Unuccessfully',
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
        $brand = Brand::find($id);
        if($brand){
            return view('backend.brands.edit',compact('brand'));
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
        $brand = Brand::find($id);
        if($brand){
            
            $data = $request->all();
            
            $status = $brand->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'Brand Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('brand.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Brand Update Unuccessfully',
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
        $brand = Brand::find($id);
        if($brand){
            $status = $brand->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Brand Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('brand.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Brand Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
