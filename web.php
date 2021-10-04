<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SystemController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => 'admin', 'middleware'=> ['auth', 'adminAuth']], function() {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.home');

    Route::get('/categories', function(){
        return view('admin.categories');
    })->name('admin.categories');
    Route::get('/ads', function(){
        
        return view('admin.ads');
    })->name('admin.ads');
 Route::post('admin/ads', [SystemController::class, 'ads'])->name('admin.ads');
//  Route::put('admin/ads/update/{id}', [SystemController::class, 'update'])->name('admin.ads.update');



   
  


});

Route::group(['prefix'=> 'user'], function(){
   Route::get('/account', function(){
       return view('my-account');
   })->name('user.account');
});

Route::get('/admin/login', [AuthController::class, 'adminLoginPage'])->name('admin.loginPage');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
// Route::get('admin/ads', [AuthController::class, 'ads'])->name('admin.ads');


Route::get('/login', [AuthController::class, 'userLoginPage'])->name('user.loginPage');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');



