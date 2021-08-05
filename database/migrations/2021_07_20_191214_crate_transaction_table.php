<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('date');
            $table->string('code');
            $table->integer('reference');
            $table->integer('type');
            $table->integer('status');
            $table->dateTime('lastEventDate')->nullable();
            $table->integer('paymentMethodType');
            $table->integer('paymentMethodCode');
            $table->float('grossAmount')->nullable();
            $table->float('discountAmount')->nullable();

            $table->float('creditorFeesInstallmentFeeAmount')->nullable();
            $table->float('creditorFeesIntermediationRateAmount')->nullable();
            $table->float('creditorFeesIntermediationFeeAmount')->nullable();

            $table->float('netAmount')->nullable();
            $table->float('extraAmount')->nullable();
            $table->integer('installmentCount')->nullable();
            $table->integer('itemCount')->nullable();

            $table->integer('itemId');
            $table->string('itemDescription');
            $table->integer('itemQuantity');
            $table->float('itemAmount');

            $table->integer('paid_amount')->nullable();
            $table->integer('refunded_amount')->nullable();
            $table->integer('installments')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('subscription_code')->nullable();
            $table->string('postback_url')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_last_digits')->nullable();
            $table->string('card_first_digits')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('boleto_url')->nullable();
            $table->string('boleto_barcode')->nullable();
            $table->dateTime('boleto_expiration_date')->nullable();
            $table->timestamps();

             
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
