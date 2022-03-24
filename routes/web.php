<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\RedirectController;

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

$shortCodeLength = config('url-shortening.shortCodeLength');

Route::get('/{any}/{code}', [RedirectController::class, 'process'])->where('code', '^[a-zA-Z0-9]{' . $shortCodeLength . '}$')->middleware('forget-params:any');
Route::get('/{code}', [RedirectController::class, 'process'])->where('code', '^[a-zA-Z0-9]{' . $shortCodeLength . '}$');
Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');
