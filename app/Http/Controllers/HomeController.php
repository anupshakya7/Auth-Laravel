<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        //assign role
        // $role = Role::where('slug','admin')->first();
        // $user->roles()->attach($role);
        // dd($user->hasRole('editor'));

        //assign permission
        // $permission=Permission::first();
        // $user->permissions()->attach($permission);
        // dd($user->permissions);
        // dd($user->can('add-post'));
        
        return view('dashboard');
    }
}
