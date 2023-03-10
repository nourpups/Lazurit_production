<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ProductsPaginate;
use Illuminate\Support\Facades\Auth;
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
// AUTH ROUTES *************************************************************************
Auth::routes([
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);
Route::get('/logout', [LoginController::class, 'logout'])->name('get.logout');
// SEARCH ROUTES *************************************************************************
Route::post('/search', [SearchController::class, 'search'])->name('search');
// CART ROUTES *************************************************************************

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('add_to_cart');
Route::get('/cart/edit_count/{product_id}/{status}', [CartController::class, 'edit_count'])->name('cart.edit_count');
Route::delete('/cart/delete/{product_id}', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');

//  FRONT END ROUTES ****************************************************************************

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/catalog/{category}', [FrontController::class, 'catalog'])->name('catalog');
Route::get('/product/{product}', [FrontController::class, 'product'])->name('product');

Route::get('/services', [FrontController::class, 'services'])->name('services');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('language/{locale}', [FrontController::class, 'change_lang'])->name('language');

// MANAGER PANEL ROUTES *************************************************************************
Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'manager'
    ],
    function () {
        Route::group(['middleware' => 'is_admin'], function () {
            Route::get('/users', [ManagerController::class, 'users'])->name('users');
            Route::get('/orders', [ManagerController::class, 'orders'])->name('orders');
            Route::get('/products', [ManagerController::class, 'products'])->name('products');
            Route::get('/categories', [ManagerController::class, 'categories'])->name('categories');
            Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
            Route::put('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
            Route::delete('/product/delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
            Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
            Route::put('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::delete('/category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
        });
    });

