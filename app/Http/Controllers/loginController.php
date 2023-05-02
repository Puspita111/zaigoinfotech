<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Models\WhitelistIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(LoginRequest $request){

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...S
           Session::put('USER_ID',Auth::id());
            
            return redirect('/dashboard');
        }
        else{
            return redirect('login')->withErrors(['invalid' =>'invalid Credentials']);
        }


    }
    public function logout(){
        Session::flush('USER_ID');
        return redirect('login');
    }
    public function signup(){
        return view('signup');
    }
    public function signupaction(SignUpRequest $request){
        
//user insert
        $user_insert = new User;
        $user_insert->name=$request->name;
        $user_insert->email=$request->email;
        $user_insert->password=Hash::make($request->password);
        $user_insert->save();

//ipwhitelist
        $ip_insert = new WhitelistIp;
        $ip_insert->user_id = $user_insert->id;
        $ip_insert->ip_address = request()->ip();
        $ip_insert->save();

        Session::put('USER_ID',$user_insert->id);

        return redirect('/dashboard');

    }

   
}
