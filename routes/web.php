<?php

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

Route::group(['namespace'=>'Client'],function (){
    Route::get('/','IndexController@home')->name('home');
    Route::get('/category/{category_id}','IndexController@getCategory')->name('getCategory');
    Route::get('/brand/{brand_id}','IndexController@getBrand')->name('getBrand');
    Route::get('/product/{id}','IndexController@productDetails')->name('productDetails');
    Route::get('/login-client','IndexController@loginClient')->name('loginClient');

    Route::post('/registration-client','LoginController@postRegistrationClient')->name('postRegistrationClient');
    Route::post('/login-client','LoginController@postLoginClient')->name('postLoginClient');
});

Route::group(['namespace'=>'Client','middleware'=>'frontLogin'],function () {
    Route::get('/cart','IndexController@cart')->name('cart');
    Route::get('/dang-xuat','LoginController@logoutClient')->name('logoutClient');

    Route::post('/save-product','IndexController@postSaveProduct')->name('postSaveProduct');
    Route::post('/update-cart-qty','IndexController@updateCartQty')->name('updateCartQty');
    Route::get('delete-cart/{rowId}','IndexController@deleteCart')->name('deleteCart');
});


Route::get('/admin','AdminLoginController@adminLogin')->name('adminLogin');

Route::group(['namespace'=>'Admin','prefix'=>'/admin','as'=>'admin.','middleware'=>['auth','admin']],function (){
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('category','CategoryProductController');
    Route::resource('brand','BrandController');
    Route::resource('product','ProductController');
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
