<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use DB;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::orderBy('id','DESC')->get(); 
        return view('backend.banners.index',compact('banners'));
    }

    public function bannerStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'photo'=> 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug .= time().'_'.$slug;
        }
        $data['slug']= $slug;
        $status = Banner::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Banner Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Banner Created Unuccessfully',
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
        $banner = Banner::find($id);
        if($banner){
            return view('backend.banners.edit',compact('banner'));
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
        $banner = Banner::find($id);
        if($banner){
            $validated = $request->validate([
                'title' => 'string|required',
                'description' => 'string|nullable',
                'photo'=> 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive',
            ]);
            $data = $request->all();
            
            $status = $banner->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'Banner Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('banner.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Banner Update Unuccessfully',
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
        $banner = Banner::find($id);
        if($banner){
            $status = $banner->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Banner Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('banner.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Banner Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
