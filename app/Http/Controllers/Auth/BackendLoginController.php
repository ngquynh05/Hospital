<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendLoginController extends Controller
{

    public function create(){
        return view('components.backend.users.login');
    }



    public function login(AdminLoginRequest $request){
        $credentials = $request->only('email','password');
        $token = Auth::guard('backend')->attempt($credentials,true);
        if($token){
            
            return redirect()->route('backend.dashboard');
        }
        return back()->withErrors([
            'email' => 'This account does not exist or the password or email is incorrect',
         ]);
    }
    public function logout(){
        
        //$user = auth()->guard('backend')->user();
        
        $user = Auth::guard('backend')->user();
        if($user){
            Auth::guard('backend')->logout();
            
        }
        return redirect()->route('backend.login');
    }
    
}



