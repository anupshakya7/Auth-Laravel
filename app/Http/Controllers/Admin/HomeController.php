<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        // dd(Auth::guard('admin')->user()->hasRole('editor'));
        return view('admin.dashboard');
    }
}
