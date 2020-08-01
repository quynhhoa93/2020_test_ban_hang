<?php

namespace App\Http\Controllers\Client;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;


class LoginController extends Controller
{
    public function postRegistrationClient(Request $request){
        $data = $request->all();
        $userCount = User::where('email',$data['email'])->count();
        if ($userCount >1){
            Toastr::warning('email nay da duoc dang ky','canh bao');
            return redirect()->back();
        }else {
            $user_client = new User();
            $user_client->name = $data['name'];
            $user_client->email = $data['email'];
            $user_client->password = bcrypt($data['password']);
            $user_client->save();
        }

        if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
            Session::put('frontSession',$data['email']);
            return redirect()->route('cart');
        }
    }

    public function postLoginClient(Request $request){
        $data = $request->all();
        if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            Session::put('frontSession',$data['email']);
            return redirect()->route('cart');
        }else{
            Toastr::warning('sảy ra lỗi khi đăng nhập','canh bao');
            return redirect()->back();
        }
    }

    public function logoutClient(){
        Session::forget('frontSession');
        Auth::logout();
        return redirect()->route('home');
    }
}

