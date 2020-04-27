<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
//redirecting to an action in a controller make use of --use Redirect
// use Redirect;
// then use the action Method and redirect to the Controller@method

class AdminController extends Controller
{
    //
    public function login(Request $request) {
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'], 'password'=> $data['password'], 'admin'=>'1'])){
                // echo "Success"; die;
                // Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            }else {
                // echo "Failed"; die;
                return redirect('/admin')->with('flash_message_error', 'Invalid Email or Password');
            }
        }
        else return view('admin.admin_login');
    }

    public function dashboard() {
        // if(Session::has('adminSession')){
        //     return view('admin.dashboard');
        // }
        // else return redirect('/admin')->with('flash_message_error','Please Login');
        return view('admin.dashboard');
        
    }
    public function settings() {
        return view('admin.settings');
        
    }

    public function checkPassword(Request $request){
        $current_password = $request->current_pwd;
        $chk_password = $request->user()->password;
        
        if(Hash::check($current_password,$chk_password)){
            return "true";
        }else {
            return "false";
        }
    }

    public function updatePassword(Request $request){
        $data = $request->input();
        $new_password = $data['new_pwd'];
        $current_password = $data['current_pwd'];
        $chk_password = $request->user()->password;
        if(Hash::check($current_password,$chk_password)){
            $request->user()->fill([
                'password' => Hash::make($new_password)
            ])->save();
        return redirect('/admin/settings')->with('flash_message_success', 'Password Changed Successfully');

        }else {
            return redirect('/admin/settings')->with('flash_message_error', 'Invalid Current Password');
        }
    }

    public function logout() {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully');
    }
}
