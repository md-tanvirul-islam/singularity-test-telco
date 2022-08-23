<?php

use App\Http\Controllers\ApiController\OutletController;
use App\Http\Controllers\ApiController\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api','as' => 'api'], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/outlets/maps', [OutletController::class, 'maps'])->name('outlets.maps');
});

Route::apiResources([
    'users' => UserController::class,
    'outlets' => OutletController::class,
], ['as' => 'api']);
