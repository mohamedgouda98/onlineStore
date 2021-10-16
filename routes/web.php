<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductColorController;
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

    Route::group(['prefix'=>"productColor",'middleware'=>['auth','adminAuth']],function (){
        Route::get('/',[ProductColorController::class,'index'])->name('admin.productColor');
        Route::post('/store',[ProductColorController::class,'store'])->name('admin.productcolor.add');
        Route::get('/edit/{id}',[ProductColorController::class,'edit'])->name('admin.productColor.editPage');
        Route::put('/edit/{id}',[ProductColorController::class,'update'])->name('admin.productcolor.edit');
        Route::delete('/delete/{id}',[ProductColorController::class,'delete'])->name('admin.productcolor.delete');
    });

});

Route::group(['prefix'=> 'user', 'middleware' => 'auth'], function(){
   Route::get('/account', function(){
       return view('my-account');
   })->name('user.account');

    Route::get('cart', [OrderController::class, 'index'])->name('cart.index');
    Route::post('cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    Route::delete('cart/delete', [OrderController::class, 'deleteCart'])->name('cart.delete');
    Route::put('cart/update', [OrderController::class, 'updateCart'])->name('cart.update');
    Route::post('cart/checkout', [OrderController::class, 'checkoutCart'])->name('cart.checkout');

});

Route::group([],function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/products/{category_id}', [HomeController::class, 'categoryProducts'])->name('products');
    Route::get('/product/details/{slug}', [ProductColorController::class, 'productDetails'])->name('product.details');
});


Route::get('/admin/login', [AuthController::class, 'adminLoginPage'])->name('admin.loginPage');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('/login', [AuthController::class, 'userLoginPage'])->name('user.loginPage');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
