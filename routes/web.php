<?php

use App\Http\Controllers\DetailController;
use App\Http\Controllers\SubscriberController;
use App\Models\Detail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SubscriberController::class, 'index']);
Route::get('/provider', [DetailController::class, 'index']);
Route::post('/save', [SubscriberController::class, 'store']);
Route::get('/show/{id}', [SubscriberController::class, 'show']);
Route::get('/edit/{id}', [SubscriberController::class, 'edit']);
Route::post('/destroy', [SubscriberController::class, 'destroy']);
Route::post('/save-provider', [DetailController::class, 'store']);
Route::post('/update/{id}', [SubscriberController::class, 'update']);
Route::post('/delete-provider/{id}', [DetailController::class, 'destroy']);