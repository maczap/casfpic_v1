<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostbackController;
use App\Http\Controllers\ControllerWebhook;

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
Route::post('postback_rc', [PostbackController::class,'postback_rc'])->name('postback_rc');

Route::get('postback/transaction', [PostbackController::class,'dadosTransaction'])->name('dadosTransaction');

Route::get('checkout/success', [PostbackController::class,'success'])->name('success');
Route::get('checkout/billet', [PostbackController::class,'billet'])->name('billet');
Route::get('checkout/pix', [PostbackController::class,'pix'])->name('pix');
Route::get('checkout/failure', [PostbackController::class,'failure'])->name('failure');
Route::get('checkout/pending', [PostbackController::class,'pending'])->name('pending');

Route::post('webhooks/clicks', [ControllerWebhook::class,'webhooks'])->name('webhooks_cliks');
Route::post('webhooks/delivered', [ControllerWebhook::class,'webhooks'])->name('webhooks_delivered');
Route::post('webhooks/opens', [ControllerWebhook::class,'webhooks'])->name('webhooks_opens');
Route::post('webhooks/permanent_failure', [ControllerWebhook::class,'webhooks'])->name('webhooks_permanent_failure');
Route::post('webhooks/spam_complaints', [ControllerWebhook::class,'webhooks'])->name('webhooks_spam_complaints');
Route::post('webhooks/temporary_failure', [ControllerWebhook::class,'webhooks'])->name('webhooks_temporary_failure');
Route::post('webhooks/unsubscribes', [ControllerWebhook::class,'webhooks'])->name('webhooks_unsubscribes');

