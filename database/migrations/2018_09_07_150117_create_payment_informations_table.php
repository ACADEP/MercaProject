<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->string('idCardOpenpay')->nullable();
            $table->string('numtarjeta')->nullable();
            $table->string('titular')->nullable();
            $table->string('vigencia')->nullable();
            $table->string('cvc')->nullable();
            $table->string('marca')->nullable();
            $table->string('ultimosdigitos')->nullable();
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
        Schema::dropIfExists('payment_informations');
    }
}
