<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerCadastro;
use App\Http\Controllers\ControllerPlans;
use App\Http\Controllers\PostbackController;

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

Route::get('/cadastro/{plano?}/{periodo?}', [ControllerHome::class,'home'])->name('home');




Route::get('/getsession', [ControllerCadastro::class,'getSession'])->name('getsession');

Route::get('/getplan/{plano}/{periodo}', [ControllerPlans::class,'get_plan'])->name('getplan');

Route::post('/payment/credit', [ControllerCadastro::class,'cadastro'])->name('payment_credit');
Route::post('/payment/boleto', [ControllerCadastro::class,'boleto'])->name('payment_boleto');

Route::get('consultar_transaction/{code}', [PostbackController::class,'transaction_code'])->name('consultar_transaction');



Route::get('success', [ControllerCadastro::class,'success'])->name('success');


