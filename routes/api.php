<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Routes without auth

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::post('password/email', [ForgotPasswordController::class, 'forgot']);

Route::post('password/reset', [ForgotPasswordController::class, 'reset']);

Route::resource('clients', 'Admin\ClientsController', ['except' => ['create', 'edit']]);

Route::resource('contact', 'ContactUsFormController', ['except' => ['index', 'create', 'show', 'edit', 'update','destroy']]);

//Routes with auth
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::resource('report', 'ReportController', ['except' => ['create', 'edit']]);
    Route::resource('users', 'Admin\UsersController', ['except' => ['create']]);
    Route::resource('users/{user}/invoices', 'Admin\invoicesDocumentController', ['except' => []]);
    Route::resource('users/{user}/business', 'BusinessesController', ['except' => []]);
    Route::resource('contactadmin', 'ContactUsFormController', ['except' => ['create', 'edit']]);
    Route::resource('tickets', 'TicketsController', ['except' => []]);
    Route::resource('tickets/comment', 'CommentsController', ['except' => []]);
    Route::resource('categories', 'Admin\CategoriesController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'profile'], function(){
        Route::get('', 'Admin\UsersController@profile')->name('profile');
        Route::patch('update', 'Admin\UsersController@profileUpdate')->name('profile.update');
        Route::put('password', 'Admin\UsersController@passwordUpdate')->name('profile.password');
    });

    Route::post('logout', [AuthController::class, 'logout']);
});
