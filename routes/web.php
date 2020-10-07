<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubscriberController;
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
Route::group([
    'prefix' => 'subscribers',
    'as' => 'subscribers.',
], function () {
    Route::get('/', [SubscriberController::class, 'index'])
    ->name('index');

    Route::get('create', [SubscriberController::class, 'create'])
        ->name('create');

    Route::post('/', [SubscriberController::class, 'store'])->name('store');

    Route::post('update/{subscriber}', [SubscriberController::class, 'update'])->name('update');
    Route::get('destroy/{subscriber}', [SubscriberController::class, 'destroy'])->name('destroy');
    Route::group(['prefix' => '{subscriber}'], function () {
        Route::get('edit', [SubscriberController::class, 'edit'])
            ->name('edit');
    });
});
