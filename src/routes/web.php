<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Tasks\StoreController;
use App\Http\Controllers\Admin\Tasks\CreateController;
use App\Http\Controllers\Admin\Tasks\IndexController;
use App\Http\Controllers\Admin\Tasks\Statistics\IndexController as StatisticIndexController;



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
//    return view('welcome');

    return "HELLO FROM FIRST CI/CD";
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::post('/tasks/create', StoreController::class);
    Route::get('/tasks/create', CreateController::class)->name('create_task');
    Route::get('/users/tasks', IndexController::class);
    Route::get('/users/tasks/statistics', StatisticIndexController::class);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
