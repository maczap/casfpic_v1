<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('admin')->default(0);
            $table->boolean('supervisor')->default(0);
            $table->boolean('promotor')->default(0);
            $table->boolean('cliente')->default(0);

            $table->string('code_pagseguro')->nullable();
            $table->integer('super_id')->nullable();
            $table->string('promotor_code',6)->nullable();


            $table->string('cep',12)->nullable();
            $table->string('endereco',80)->nullable();
            $table->string('numero',12)->nullable();
            $table->string('complemento',40)->nullable();
            $table->string('bairro',50)->nullable();
            $table->string('cidade',50)->nullable();
            $table->string('uf',2)->nullable();

            $table->string('cpf',15)->nullable();
            $table->string('rg',12)->nullable();
            $table->string('sexo',1)->nullable();

            $table->date('nascimento')->nullable();
            $table->string('ecivil',12)->nullable();
            $table->string('area_atuacao',100)->nullable();
            $table->string('profissao',80)->nullable();
            $table->string('celular',15)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
