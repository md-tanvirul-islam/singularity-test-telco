<?php

use App\Http\Controllers\WebController\OutletController;
use App\Http\Controllers\WebController\UserController;
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

require __DIR__.'/auth.php';

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/outlets/maps', [OutletController::class, 'maps'])->name('outlets.maps');

    Route::resources([
        'users' => UserController::class,
        'outlets' => OutletController::class,
    ]);
});
