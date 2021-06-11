<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ProductController as ProductController;
use App\Http\Controllers\CategoryController as CategoryController;

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


// Route::get('profile', function () {

// })->middleware('auth');
Route::middleware('checkLogin')->group(function () {
    //user start
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/change-password', 'UserController@changePassword')->name('change-password');
    Route::post('/update-password', 'UserController@updatePassword')->name('update-password');
    Route::get('/account-information', 'UserController@accountInfor')->name('account-infor');
    //user end
    // category start
    Route::get('/category/list', 'CategoryController@list')->name('category-list');
    Route::get('/category/create', 'CategoryController@create')->name('category-create');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category-edit');
    Route::post('/category/update', 'CategoryController@update')->name('category-update');
    Route::get('/category/remove/{id}', 'CategoryController@remove')->name('category-remove');
    Route::get('/category/classify/{level}', 'CategoryController@classify')->name('category-classify');
    Route::get('/category/classify/edit/{level}/{id}', 'CategoryController@classifyEdit')->name('category-classify-edit')->where(['level' => '[2-3]+']);
    Route::post('/category/classify/update/{level}', 'CategoryController@classifyUpdate')->name('category-classify-update')->where(['level' => '[2-3]+']);;

    // category end
    // product start
    Route::get('/product/list', 'ProductController@list')->name('product-list');
    Route::get('/product/create', 'ProductController@create')->name('product-create');
    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product-edit');
    Route::post('/product/update', 'ProductController@update')->name('product-update');
    Route::get('/product/remove/{id}', 'ProductController@remove')->name('product-remove');
    // product end
    // order start
    Route::get('/order/list', 'OrderController@list')->name('order-list');
    Route::get('/order/{id}', 'OrderController@view')->name('order-view')->where('id', '[0-9]+');;
    Route::get('/order/create', 'OrderController@create')->name('order-create');
    Route::get('/order/edit/{id}', 'OrderController@edit')->name('order-edit');
    Route::post('/order/update', 'OrderController@update')->name('order-update');
    Route::get('/order/remove/{id}', 'OrderController@remove')->name('order-remove');
    // order end
    Route::post('/call_ajax', 'AjaxController@callAjax')->name('call-ajax');
    Route::post('/call_ajax_customer', 'AjaxController@callAjaxCustomer')->name('call-ajax-customer');
    Route::post('/call_ajax_product', 'AjaxController@callAjaxProduct')->name('call-ajax-product');
    Route::post('/call_ajax_add_customer', 'AjaxController@callAjaxAddCustomer')->name('call-ajax-add-customer');
});
Route::get('/', 'UserController@login')->name('home');
Route::post('/login', 'UserController@authenticate')->name('login');

//create
// Route::get('/register', 'UserController@register')->name('register');
Route::post('/register', 'UserController@createUser');
//logout
