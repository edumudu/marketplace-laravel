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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@show')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
  Route::get('/', 'cartController@index')->name('index');
  Route::post('/add', 'cartController@add')->name('add');
  Route::get('/remove/{slug}', 'cartController@remove')->name('remove');
  Route::get('/cancel', 'cartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
  Route::get('/', 'CheckoutController@index')->name('index');
  Route::post('/process', 'CheckoutController@process')->name('process');
  Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

  Route::post('/notification', 'CheckoutController@notification')->name('notification');
});

Route::middleware('auth')->group(function() {
  Route::get('/my-orders', 'UserOrderController@index')->name('user.orders');
  
  Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('access.control.store.admin')->group(function() {
    Route::resource('stores', 'StoreController');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    
    Route::post('/photos/remove', 'ProductPhotoController@destroy')->name('photo.destroy');
    
    Route::get('/orders/my', 'OrdersController@index')->name('orders.my');

    Route::get('/notifications', 'NotificationController@notifications')->name('notification.index');
    Route::get('/notifications/read-all', 'NotificationController@readAll')->name('notification.read.all');
    Route::get('/notifications/read/{notification}', 'NotificationController@read')->name('notification.read');
  });
});

Auth::routes();
