<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminControllers\OrderController;
use App\Http\Controllers\adminControllers\UsersController;
use App\Http\Controllers\adminControllers\AdminsController;
use App\Http\Controllers\adminControllers\CategoryController;
use App\Http\Controllers\adminControllers\ProductColorController;
use App\Http\Controllers\adminControllers\ProductController;
use App\Http\Controllers\adminControllers\WishListsController;

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



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'adminAuth']], function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('home');

    Route::group(['prefix' => "category", 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });


    Route::group(['prefix' => "productColor"], function () {
        Route::get('/', [ProductColorController::class, 'index'])->name('productColor');
        Route::post('/store', [ProductColorController::class, 'store'])->name('productcolor.add');
        Route::get('/edit/{id}', [ProductColorController::class, 'edit'])->name('productColor.editPage');
        Route::put('/edit/{id}', [ProductColorController::class, 'update'])->name('productcolor.edit');
        Route::delete('/delete/{id}', [ProductColorController::class, 'delete'])->name('productcolor.delete');
    });
    Route::group(['prefix' => "product"], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.editPage');
        Route::put('/edit/{id}', [ProductController::class, 'update'])->name('product.edit');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });
    Route::group(['prefix' => "users"], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::post('/store', [UsersController::class, 'store'])->name('users.add');
        Route::post('/changeStatus/{id}', [UsersController::class, 'editStatus'])->name('users.editStatus');
        Route::delete('/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');
    });
    Route::group(['prefix' => "wishlists"], function () {
        Route::get('/', [WishListsController::class, 'index'])->name('wishLists');
    });
});

Route::group(['prefix' => 'owner', 'middleware' => ['auth', 'ownerAuth']], function () {
    Route::group(['prefix' => "admins", 'middleware' => ['auth', 'adminAuth']], function () {
        Route::get('/', [AdminsController::class, 'index'])->name('owner.admins');
        Route::post('/store', [AdminsController::class, 'store'])->name('owner.admins.add');
        Route::post('/changeStatus/{id}', [AdminsController::class, 'editStatus'])->name('owner.admins.editStatus');
        Route::delete('/delete/{id}', [AdminsController::class, 'delete'])->name('owner.admins.delete');
    });
});



/////// USER ROUTES /////////

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/account', function () {
        return view('my-account');
    })->name('user.account');

    Route::post('cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
});

Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/products/{category_id}', [HomeController::class, 'categoryProducts'])->name('products');
    Route::get('/product/details/{slug}', [ProductColorController::class, 'productDetails'])->name('product.details');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/login', [AuthController::class, 'adminLoginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/login', [AuthController::class, 'userLoginPage'])->name('user.loginPage');
Route::post('/login', [AuthController::class, 'userLogin'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
