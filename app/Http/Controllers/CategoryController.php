<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::orderBy('id','DESC')->get(); 
        return view('backend.categorys.index',compact('category'));
    }

    public function CategoryStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
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
        $parant_category = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view('backend.categorys.create',compact('parant_category'));
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
        $slug_count = Category::where('slug',$slug)->count();
        if($slug_count > 0){
            $slug .= time().'_'.$slug;
        }
        $data['slug']= $slug;
        $data['is_parent'] = $request->input('parent_id',0);
        $status = Category::create($data);

        if ($status) {
            $notification = array(
                'message' => 'Category Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('category.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'Category Created Unuccessfully',
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
        $category = Category::find($id);
        $parant_category = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        if($category){
            return view('backend.categorys.edit',compact(['category','parant_category']));
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
        $category = Category::find($id);
        if($category){
            $data = $request->all();
            if($request->is_parent==1){
                $data['parent_id']=null;
            }
            $data['is_parent'] = $request->input('parent_id',0);
            $status = $category->fill($data)->save();
            if ($status) {
                $notification = array(
                    'message' => 'Category Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('category.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Category Update Unuccessfully',
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
        $category = Category::find($id);
        $child_cat_id = Category::where('parent_id',$id)->pluck('id');
        if($category){
            $status = $category->delete();
            if ($status) {
                if(count($child_cat_id)>0){
                    Category::shifChild($child_cat_id);
                }
                $notification = array(
                    'message' => 'Category Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('category.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Category Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getChildByParentId(Request $request, $id){
        //dd($id);
        $category =  Category::find($request->id);
        if($category){
            $child_id = Category::getChildByParentId($request->id);
            if(count($child_id)<=0){
                return response()->json(['status'=>false,'data'=>null,'msg'=>'']);
            }
            return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
        }else{
            return response()->json(['status'=>false,'data'=>null,'msg'=>'Category Not Found']);
        }
    }
}
