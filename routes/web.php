<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerCadastro;
use App\Http\Controllers\ControllerPlans;
use App\Http\Controllers\PostbackController;
use App\Http\Controllers\ControllerPromotores;

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

Route::get('/testa_email', [ControllerCadastro::class,'testaEmail'])->name('testaEmail');

Route::get('consultar_transaction/{code}', [PostbackController::class,'transaction_code'])->name('consultar_transaction');
Route::get('consultar_notification/{code}', [PostbackController::class,'consultar_notificacao'])->name('consultar_notificacao');


Route::get('autorizacao', [PostbackController::class,'autorizacao'])->name('autorizacao');
Route::get('consultar_autorizacao', [PostbackController::class,'consultar_autorizacao'])->name('consultar_autorizacao');
Route::get('consultar_pagamento/{id}', [PostbackController::class,'consultar_pagamento'])->name('consultar_pagamento');


Route::get('success_boleto', [ControllerCadastro::class,'success'])->name('success');
Route::get('api/postback', [ControllerCadastro::class,'preaproval'])->name('preaproval');


Route::get('get-promotor/{code}', [ControllerPromotores::class,'getPromotor'])->name('getPromotor');

Route::get('teste_plan_create', [ControllerPlans::class,'CreatePlan'])->name('createPlan');
Route::get('assinatura', [ControllerCadastro::class,'Assinatura'])->name('assinatura');

Route::get('gerar_token', [ControllerCadastro::class,'generatePassword'])->name('generatePassword');

Route::get('p/{code}', [ControllerPromotores::class,'link_promotor'])->name('link_promotor');


Route::get('/test_json', function () {

});

Route::middleware(['admin'])->group(function () {
    Route::get('admin',function() {
        dd("voce é admin");
    });
});

Route::middleware(['client'])->group(function (){
    Route::get('client',function() {
        dd("voce é admin");
    });
});

Route::get('/teste_data', function () {
    $data =  (new \DateTime())->format('Y-m-d\TH:i:s');

    $date1 = date("Y-m-d\TH:i:s", strtotime($data.'+ 5 days'));
    // $data = $data->format('Y-m-d\TH:i:s.u'); 
    return $date1;
});



