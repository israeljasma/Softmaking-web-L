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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin route users
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show', 'store']]);
});

// Admin route invoices
Route::namespace('Admin')->prefix('admin/users/{user}')->name('admin.')->middleware('can:manage-invoices')->group(function($user){
    Route::resource('/invoices', 'invoicesDocumentController', ['except' => []]);
});

// User route invoices
Route::get('/home/invoices', 'Admin\invoicesDocumentController@indexUser')->name('user.invoices.index');
Route::resource('home/invoices', 'Admin\invoicesDocumentController',['except' => ['index','store', 'create', 'show', 'edit', 'update', 'destroy']]);

// Render in view
Route::get('/contact', [
    'uses' => 'ContactUsFormController@createForm'
]);

// Post form data
Route::post('/contact', [
    'uses' => 'ContactUsFormController@ContactUsForm',
    'as' => 'contact.store'
]);