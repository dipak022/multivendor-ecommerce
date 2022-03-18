<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function ShowLoginForm(){
        return view('backend.auth.login');
    }

    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            //dd($request->all());
            $notification = array(
                'message' => 'Login your account Successfully',
                'alert-type' => 'success'
            );
            return redirect()->intended(route('admin'))->with($notification);

        }
        return back()->withInput($request->only('email'));
        //dd($request->all());

    }
}
