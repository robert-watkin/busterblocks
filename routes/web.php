<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::group(['middleware' => 'web'], function () {
Auth::routes();

Route::get('/', "PagesController@index");
Route::get('/basket', "BasketController@Index")->name('basket.index');

Route::get('/admin/login', 'Auth\AdminLoginController@ShowLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@Login')->name('admin.login.submit');

Route::get('/checkout/order-details', 'CheckoutController@ShowCheckoutForm');
Route::get('/checkout/order-confirmed', 'CheckoutController@SubmitCheckout')->name('checkout.submit');

Route::patch('/basket/{product}', "BasketController@Update");
Route::get('/AddToBasket/{id}', "BasketController@AddToBasket");

Route::resource('products', "ProductsController")->name('index','product');
});