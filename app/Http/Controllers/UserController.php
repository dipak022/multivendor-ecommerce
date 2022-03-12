<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::orderBy('id','DESC')->get(); 
        return view('backend.users.index',compact('user'));
    }

    public function userStatus(Request $request){
        //dd($request->all());
        if($request->mode == 'true'){
            $status = DB::table('users')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            $status = DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        if ($status) {
            $notification = array(
                'message' => 'User Change Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'User Change Unuccessfully',
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
        return view('backend.users.create');
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
        
        $data['password']= Hash::make($request->password);
        //return $data;
        $status = User::create($data);

        if ($status) {
            $notification = array(
                'message' => 'User Created Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('user.index')->with($notification);
        }else{
            $notification = array(
                'message' => 'User Created Unuccessfully',
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
        $user = User::find($id);
        if($user){
            return view('backend.users.edit',compact('user'));
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
        $user = User::find($id);
        if($user){
            
            $data = $request->all();
            
            $status = $user->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'User Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.index')->with($notification);
            }else{
                $notification = array(
                    'message' => 'User Update Unuccessfully',
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
        $user = User::find($id);
        if($user){
            $status = $user->delete();
            if ($status) {
                $notification = array(
                    'message' => 'user Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('user.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'User Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
