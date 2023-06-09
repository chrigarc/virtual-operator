<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/call', [\App\Http\Controllers\CallController::class, 'call'])->name('call');
Route::post('/call/bye', [\App\Http\Controllers\CallController::class, 'bye'])->name('call.bye');
Route::post('/call/gather', [\App\Http\Controllers\CallController::class, 'gather'])->name('call.gather');
