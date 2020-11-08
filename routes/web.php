<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
/*
|-------------------------------------
| User Routes
|-------------------------------------
*/
Auth::routes();



/*
|--------------------------------------
| Main Routes (Home)
|--------------------------------------
*/

    Route::get('/', 'HomeController@index')->name('Ecommerce');
    Route::group(['prefix'=>"/"],function(){
        Route::get('shop', 'HomeController@shop')->name('shop');
        Route::get('machine', 'HomeController@machine')->name('machine');
        Route::get('shop/{id}/{slug}/{mac?}', 'HomeController@SpecificCateg')->name('shop.category');
        Route::get('shop/product/{id}/{slug}', 'HomeController@product')->name('shop.product');
/*
|--------------------------------------
| Shop Routes
|--------------------------------------
*/
        Route::group(['prefix'=>"shop"],function(){
            Route::get('cart', 'CartController@index')->name('shop.cart');
            Route::post('cart/add/{id}', 'CartController@store')->name('cart.add');
            Route::get('cart/remove/{id}', 'CartController@remove')->name('cart.remove');
            Route::post('cart/update/{id}', 'CartController@update')->name('cart.update');

        });
    });



/*
|--------------------------------------
| Admin Routes
|--------------------------------------
*/

Route::group(['middleware' => 'admin' ], function () {

    Route::get('/admin', function() {
        return redirect('admin/dashboard');
    });


    Route::group(['prefix'=>"admin"],function(){
/*
|--------------------------------------
| Admin Controller
|--------------------------------------
*/

        Route::get('dashboard', 'Admin\HomeController@index')->name('home');

        Route::resource('admins', 'Admin\AdminController', ['except' => ['show']]);

        Route::resource('users', 'Admin\UserController', ['except' => ['show']]);
/*
|--------------------------------------
| Categories Controller
|--------------------------------------
*/
        Route::resource("categories",'CategoryController',[
            'names' => [
                'index' => 'categories',
            ]]);
        Route::get('categries/activation/{id}', 'CategoryController@activation')->name('categories.activation');
/*
|--------------------------------------
| Products Controller
|--------------------------------------
*/
        Route::resource("products",'ProductController',[
            'names' => [
                'index' => 'products',
            ]]);
        Route::get('products/activation/{id}', 'ProductController@activation')->name('products.activation');
        Route::get('products/availability/{id}', 'ProductController@availability')->name('products.availability');
        Route::get('products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');

/*
|--------------------------------------
| Orders Controller
|--------------------------------------
*/
        Route::group(['prefix'=>"orders"],function(){
                Route::get('{status}', 'OrderController@index')->name('orders');
                Route::get('show/{id}', 'OrderController@show')->name('order.show');
                Route::post('shipped/{id}', 'OrderController@shipped')->name('order.shipped');
                Route::post('delivered/{id}', 'OrderController@delivered')->name('order.delivered');
                Route::get('canceled/{id}', 'OrderController@canceled')->name('order.canceled');
                Route::post('delete/{id}', 'OrderController@destroy')->name('order.delete');
            });
        });

        /*
|--------------------------------------
| Notifications
|--------------------------------------
*/
        Route::get("markAsRead",function(){
            DB::table('notifications')->truncate();
            return redirect()->back();
        })->name('notify_clear');
        Route::get("markAsRead_for_element/{notify}",function($notify){

            DB::table('notifications')
            ->where('id', $notify)->delete();
            return redirect()->back();
        })->name('notify_element');

/*
|--------------------------------------
| Setting Controller
|--------------------------------------
*/
        Route::resource("settings",'SettingController',[
            'names' => [
                'index' => 'settings',
            ]]);
        Route::get('settings/destroy/{setting}', 'SettingController@destroy')->name('settings.destroy');

});

Route::group(['middleware' => 'auth' ], function () {
/*
|--------------------------------------
| CheckOut Order
|--------------------------------------
*/
    Route::get('shop/check-out', 'CartController@checkOut')->name('cart.checkOut');
    Route::post('shop/check-out/placeOrder', 'CartController@placeOrder')->name('cart.placeOrder');
    //Route::get('main/shop/trackOrder', 'CartController@trackOrder')->name('cart.tracking');
/*
|--------------------------------------
| Profile Settings
|--------------------------------------
*/
    Route::group(['prefix'=>"profile"],function(){
        Route::get('/', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);

        Route::put('/', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);

        Route::put('/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
    });
});

