<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuController;

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

Route::get('/', [BukuTamuController::class, 'index']);
Route::post('/', [BukuTamuController::class, 'store']);
Route::get('download-now', [BukuTamuController::class, 'download_now']);
Route::get('download-all', [BukuTamuController::class, 'download_all']);
