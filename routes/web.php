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
Route::namespace('Admin')->prefix('home')->name('user.')->group(function(){
    Route::get('/invoices', 'invoicesDocumentController@indexUser')->name('invoices.index');
    Route::get('/invoices/{invoice}', 'invoicesDocumentController@showUser', function ($invoice){})->name('invoices.show');
    Route::resource('/invoices', 'invoicesDocumentController',['except' => ['index','store', 'create', 'show', 'edit', 'update', 'destroy']]);
});

// User route tickets & comments
Route::resource('/home/ticket', 'TicketsController',['except' => []]);
Route::resource('/home/ticket/comment', 'CommentsController', ['except' => []]);

// Render in view
Route::get('/contact', [
    'uses' => 'ContactUsFormController@createForm'
]);

// Post form data
Route::post('/contact', [
    'uses' => 'ContactUsFormController@ContactUsForm',
    'as' => 'contact.store'
]);