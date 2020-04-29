<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

//home page
Route::get('/','IndexController@index');

Route::match(['get','post'],'/admin', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');

//Product Listing Page
Route::get('/products/{url}', 'ProductsController@products');

//group of middleware to be unable to access url's without authentication
Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPassword');
    Route::match(['get','post'],'/admin/update-pwd', 'AdminController@updatePassword');


    //Categories routes (Admin)
    Route::match(['get','post'], '/admin/add-category','CategoriesController@addCategory');
    Route::get('/admin/view-category','CategoriesController@viewCategories');
    Route::get('/admin/delete-category/{id}','CategoriesController@deleteCategory');
    Route::match(['post','get'],'/admin/edit-category/{id}', 'CategoriesController@editCategory');

    //Product routes (Admin)
    Route::match(['post','get'],'/admin/add-product', 'ProductsController@addProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProducts');
    Route::match(['post','get'],'/admin/edit-product/{id}', 'ProductsController@editProduct');

    //ProductAttribute routes
    Route::match(['get','post'],'/admin/add-attribute/{id}', 'ProductsController@addAttributes');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
