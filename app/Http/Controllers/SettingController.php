<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Setting;
use Illuminate\Support\Str;
use DB;
class SettingController extends Controller
{
    public function seeting(){
        $seeting=Setting::first();
        return view('backend.seeting.seeting',compact('seeting'));
    }

    public function SeetingUpdate(Request $request, $id){
        $setting = Setting::find($id);
        if($setting){
            
            $data = $request->all();
            
            $status = $setting->fill($data)->save();
    
            if ($status) {
                $notification = array(
                    'message' => 'Setting Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('seeting')->with($notification);
            }else{
                $notification = array(
                    'message' => 'Setting Update Unuccessfully',
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
}
