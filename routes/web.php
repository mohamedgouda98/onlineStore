<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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


    Route::get('/products', [ProductController::class,'index'])->name('admin.products');
    Route::post('/product/store', [ProductController::class,'store'])->name('admin.product.store');
    Route::get('/product/edite/{id}', [ProductController::class,'edite'])->name('admin.product.edite');
    Route::put('/product/update', [ProductController::class,'update'])->name('admin.product.update');
    Route::get('/product/delete/{id}', [ProductController::class,'delete'])->name('admin.product.delete');
});

Route::group(['prefix'=> 'user'], function(){
   Route::get('/account', function(){
       return view('my-account');
   })->name('user.account');
});

Route::get('/admin/login', [AuthController::class, 'adminLoginPage'])->name('admin.loginPage');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('/login', [AuthController::class, 'userLoginPage'])->name('user.loginPage');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
