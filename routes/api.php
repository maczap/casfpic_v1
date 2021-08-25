<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostbackController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('postback', [PostbackController::class,'transaction'])->name('transaction');

Route::get('checkout/success', [PostbackController::class,'success'])->name('success');
Route::get('checkout/failure', [PostbackController::class,'transaction'])->name('transaction');
Route::get('checkout/pending', [PostbackController::class,'transaction'])->name('transaction');

