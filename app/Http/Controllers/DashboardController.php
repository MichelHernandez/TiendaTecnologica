<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RolService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function superIndex(){
        if(RolService::verifyIsAdmin(Auth::id())){
            return view('admindashboard');
        }
        return redirect()->route('dashboard');
    }

    public function index(){
        return view('dashboard');
    }
}
