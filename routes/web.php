<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\HomeController as UserHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>['auth','verified']],function(){
    Route::get('/dashboard',[UserHomeController::class,'dashboard'])->name('dashboard');
    Route::get('role',function(){
        $user = Auth::user();

        if($user->hasRole('admin')){
            dd('admin');
        }
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::group(['middleware'=>'role:admin'],function(){
    Route::get('role',function(){
       dd('hi');
    });
});



require __DIR__.'/auth.php';

//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        //login route

        Route::get('login',[AuthenticatedSessionController::class,'create'])->name('login');
        Route::post('login',[AuthenticatedSessionController::class,'store'])->name('login.store');
    });

    Route::middleware('admin')->group(function(){
        Route::get('dashboard',[HomeController::class,'index'])->name('dashboard');
    });
    
    Route::post('logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');
});
