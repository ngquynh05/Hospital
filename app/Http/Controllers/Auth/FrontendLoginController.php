<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class FrontendLoginController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        
    }
    public function index(){
        return view('components.frontend.users.login');
    }
    public function store(StoreUserRequest $request){
        $credentials = $request->only('email','password');
        $token = Auth::guard('web')->attempt($credentials,true);
        
        if($token){
            
            return redirect()->route('frontend.home');
        }
        return back()->withErrors([
            'name' => 'Ten khong duoc bo trong',
            'email' => 'This account does not exist or the password or email is incorrect',
         ]);

        
        
        

    }
    public function register(){
        return view('components.frontend.users.register');
    }
    public function logout(){
        $user = Auth::guard('web')->user();
        if($user){
            Auth::guard('web')->logout();
        }
        return redirect()->route('frontend.home');
    }
    
}