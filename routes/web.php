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

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('post.login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


// ----------- Companies -----------------


// Companys list
Route::get('/', 'CompanyController@index')
    ->name('company.front');

Route::get('/company', 'CompanyController@index')
    ->name('company.index');

//Route::group(['middleware' => 'auth', 'prefix' => 'crud'], function () {

// Company view
    Route::get('/company/{id}/view', 'CompanyController@view')
        ->where('id', '[0-9]+')
        ->name('company.view');
// Company add form
    Route::get('/company/add', 'CompanyController@add')
        ->name('company.add');
// Company edit form
    Route::get('/company/{id}/edit', 'CompanyController@edit')
        ->where('id', '[0-9]+')
        ->name('company.edit');
// Company edit save
    Route::put('/company/{id}/save', 'CompanyController@save')
        ->where('id', '[0-9]+')
        ->name('company.edit.save');
// Company add save
    Route::post('/company/save', 'CompanyController@save')
        ->name('company.add.save');
// Company delete
    Route::delete('/company/delete', 'CompanyController@delete')
        ->name('company.delete');
//});


// ----------- Customers -----------------



Route::get('/customer', 'CustomerController@index')
    ->name('customer.index');

//Route::group(['middleware' => 'auth', 'prefix' => 'crud'], function () {

// Customer view
Route::get('/customer/{id}/view', 'CustomerController@view')
    ->where('id', '[0-9]+')
    ->name('customer.view');
// Customer add form
Route::get('/customer/add', 'CustomerController@add')
    ->name('customer.add');
// Customer edit form
Route::get('/customer/{id}/edit', 'CustomerController@edit')
    ->where('id', '[0-9]+')
    ->name('customer.edit');
// Customer edit save
Route::put('/customer/{id}/save', 'CustomerController@save')
    ->where('id', '[0-9]+')
    ->name('customer.edit.save');
// Customer add save
Route::post('/customer/save', 'CustomerController@save')
    ->name('customer.add.save');
// Customer delete
Route::delete('/customer/delete', 'CustomerController@delete')
    ->name('customer.delete');
//});