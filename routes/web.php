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



Auth::routes();

// User profile
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile', 'HomeController@index')->name('profile');
});

// User index
Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index']
);

// User Cart
Route::get('/add-to-cart/{id}',[
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/reduce/{id}',[
    'uses' => 'ProductController@getReduceByOne',
    'as'=> 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
   'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart',[
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);
Route::get('/checkout',[
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout',
    'middleware' =>'auth'
]);
Route::post('/checkout',[
    'uses' => 'ProductController@postCheckout',
    'as' => 'checkout',
    'middleware' =>'auth'
]);

// Admin Crud
// TODO: Setup group middleware. Auth
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function (){
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    });
