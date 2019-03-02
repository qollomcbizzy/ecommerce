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
Route::get('/', 'HomeController@index');
Auth::routes();

Route::prefix('/')->group(function () {
    Route::get('products','ProductsController@Products')->middleware('auth');
    Route::get('product/{id}','ProductsController@Product');
    Route::get('product/addCart/{id}','ProductsController@Addcart');
    Route::get('products/category','ProductsController@DepartmentCategory');
    Route::get('category/products','ProductsController@CategoryProducts');
    Route::get('products/size','ProductsController@Sizeproducts');
    Route::get('products/color','ProductsController@ColorProducts');
    Route::post('customer/register','CustomerController@RegisterCustomer');
});
Route::get('cart', 'ProductsController@cart');
//Route::patch('update-cart', 'ProductsController@update');
 
Route::delete('remove-from-cart', 'ProductsController@remove');
