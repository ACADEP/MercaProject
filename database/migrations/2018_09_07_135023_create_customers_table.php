<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario')->nullable();
            $table->string('idCustomerOpenpay')->nullable();
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('telefono')->nullable();
            $table->string('razonSocial')->nullable();
            $table->string('tipoFacturacion')->nullable();
            $table->string('rfc')->nullable();
            $table->string('calle')->nullable();
            $table->string('numInterior')->nullable();
            $table->string('numExterior')->nullable();
            $table->string('cp')->nullable();
            $table->string('estado')->nullable();
            $table->string('email')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('colonia')->nullable();
            $table->string('cfdi')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        
        $table->dropSoftDeletes();
    }
}
