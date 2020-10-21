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

// User Routes


Auth::routes();

Route::get('main', 'HomeController@index')->name('Ecommerce');
Route::get('main/shop', 'HomeController@shop')->name('shop');
Route::get('main/shop/{id}/{slug}', 'HomeController@SpecificCateg')->name('shop.category');
Route::get('main/shop/product/{id}/{slug}', 'HomeController@product')->name('shop.product');

Route::post('main/shop/product/{id}/{slug}', 'CommentController@store')->name('product.comment');

Route::get('main/shop/cart', 'CartController@index')->name('shop.cart');
Route::post('main/shop/cart/add/{id}', 'CartController@store')->name('cart.add');
Route::get('main/shop/cart/remove/{id}', 'CartController@remove')->name('cart.remove');
Route::post('main/shop/cart/update/{id}', 'CartController@update')->name('cart.update');
// Admin Routes

Route::group(['middleware' => 'admin' ], function () {

	Route::get('admin', function() {
		return redirect('admin/dashboard');
	});
    /* Admin Controller */
	Route::get('admin/dashboard', 'Admin\HomeController@index')->name('home');

	Route::resource('admin/admins', 'Admin\AdminController', ['except' => ['show']]);

	Route::resource('admin/users', 'Admin\UserController', ['except' => ['show']]);

	Route::get('main/profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);

	Route::put('main/profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);

	Route::put('main/profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
	/* Category Controller */
	Route::get('admin/categries', 'CategoryController@index')->name('categories');
	Route::get('admin/categries/create', 'CategoryController@create')->name('categories.create');
	Route::post('admin/categries/store', 'CategoryController@store')->name('categories.store');
	Route::get('admin/categries/show/{id}', 'CategoryController@show')->name('categories.show');
	Route::get('admin/categries/edit/{id}', 'CategoryController@edit')->name('categories.edit');
	Route::post('admin/categries/update/{id}', 'CategoryController@update')->name('categories.update');
	Route::get('admin/categries/activation/{id}', 'CategoryController@activation')->name('categories.activation');
	Route::get('admin/categries/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
	/* Product Controller */
	Route::get('admin/products', 'ProductController@index')->name('products');
	Route::get('admin/products/create', 'ProductController@create')->name('products.create');
	Route::post('admin/products/store', 'ProductController@store')->name('products.store');
	Route::get('admin/products/show/{id}', 'ProductController@show')->name('products.show');
	Route::get('admin/products/edit/{id}', 'ProductController@edit')->name('products.edit');
	Route::post('admin/products/update/{id}', 'ProductController@update')->name('products.update');
	Route::get('admin/products/activation/{id}', 'ProductController@activation')->name('products.activation');
	Route::get('admin/products/availability/{id}', 'ProductController@availability')->name('products.availability');
    Route::get('admin/products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
    /* Comment Controller */
    Route::get('admin/comments', 'CommentController@index')->name('comments');
    Route::get('admin/comments/product/{id}', 'CommentController@productComment')->name('comments.product');
    Route::get('admin/comments/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');
    /* Order Controller */
    Route::get('admin/orders/{status}', 'OrderController@index')->name('orders');
    Route::get('admin/orders/show/{id}', 'OrderController@show')->name('order.show');
    Route::post('admin/orders/shipped/{id}', 'OrderController@shipped')->name('order.shipped');
    Route::post('admin/orders/delivered/{id}', 'OrderController@delivered')->name('order.delivered');
    Route::get('admin/orders/canceled/{id}', 'OrderController@canceled')->name('order.canceled');
    Route::post('admin/orders/delete/{id}', 'OrderController@destroy')->name('order.delete');
    /* Website */
    Route::get('main/shop/check-out', 'CartController@checkOut')->name('cart.checkOut');
    Route::post('main/shop/check-out/placeOrder', 'CartController@placeOrder')->name('cart.placeOrder');
    Route::get('main/shop/trackOrder', 'CartController@trackOrder')->name('cart.tracking');
});
Route::group(['middleware' => 'auth' ], function () {
    /* Website */
    Route::get('main/shop/check-out', 'CartController@checkOut')->name('cart.checkOut');
    Route::post('main/shop/check-out/placeOrder', 'CartController@placeOrder')->name('cart.placeOrder');
    Route::get('main/shop/trackOrder', 'CartController@trackOrder')->name('cart.tracking');
});

