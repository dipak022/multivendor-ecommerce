<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use DB;
class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $categorys = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        return view('frontend.index',compact(['banners','categorys']));
    }
}
