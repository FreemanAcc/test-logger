<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

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
Route::get('/', function () {
    return response()->json(['message' => 'Hello logger test task'], 200);
});
Route::post('/log', [LogController::class, 'log']);
Route::post('/log/{type}', [LogController::class, 'logTo']);
Route::post('/log-all', [LogController::class, 'logToAll']);
