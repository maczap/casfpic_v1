<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->nullable();
            $table->string('payment_id')->nullable();
            $table->foreignId('plan_id');
            $table->foreignId('user_id');
            $table->string('amount',15)->nullable();
            $table->dateTime('vencimento')->nullable();
            $table->string('status');
            $table->string('status_detail')->nullable();
            $table->string('status_msg')->nullable();
            $table->string('periodo');
            $table->string('payment_method')->nullable();
            $table->string('manage_url')->nullable();
            
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('user_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
