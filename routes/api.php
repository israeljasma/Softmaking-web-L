<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::resource('clients', 'Admin\ClientsController', ['except' => ['create', 'edit']]);

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::resource('contact', 'ContactUsFormController', ['except' => ['show', 'edit', 'update','destroy']]);

//Routes with auth
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::resource('users', 'Admin\UsersController', ['except' => ['create', 'store']]);
    Route::resource('users/{user}/invoices', 'Admin\invoicesDocumentController', ['except' => []]);
    Route::resource('contact', 'ContactUsFormController', ['except' => []]);
    Route::resource('tickets', 'TicketsController', ['except' => []]);
    Route::post('logout', [AuthController::class, 'logout']);
});