<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\ColumnsController;

use App\Http\Controllers\DownloadsController;
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

//Columns Routes
Route::get('columns', [ColumnsController::class, 'getColumns']);
Route::post('columns', [ColumnsController::class, 'postAddColumn']);
Route::delete('columns', [ColumnsController::class, 'deleteColumn']);

// Cards Route
Route::post('cards', [CardsController::class, 'postAddCard']);
Route::patch('cards', [CardsController::class, 'postUpdateCard']);
Route::patch('cards/order', [CardsController::class, 'patchCardOrder']);

// Download Dump
Route::get('download-db-dump', [DownloadsController::class, 'getDbDump']);
