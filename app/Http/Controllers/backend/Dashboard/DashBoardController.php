<?php

namespace App\Http\Controllers\backend\Dashboard;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends BackendController
{
    protected $data = [];
    public function __construct(){
        parent::__construct();
        $this->data['title'] = 'Dashboard';
    }
    public function index(){
        $user = Auth::guard('backend')->user();
        $this->data['user'] = $user;
        
        return view('components.backend.dashboard.index',$this->data);
    }  
}



