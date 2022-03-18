<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function ShowLoginForm(){
        return view('backend.seller.auth.login');
    }

    public function login(Request $request){
        if(Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password])){
            //dd($request->all());
            $notification = array(
                'message' => 'Login your account Successfully',
                'alert-type' => 'success'
            );
            return redirect()->intended(route('seller'))->with($notification);

        }
        return back()->withInput($request->only('email'));
        //dd($request->all());

    }
}
