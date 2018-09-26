<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->string('calle');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('colonia');
            $table->string('cp');
            $table->string('calle2')->nullable();
            $table->string('calle3')->nullable();
            $table->string('numInterior')->nullable(); 
            $table->string('numExterior')->nullable();
            $table->text('referencias')->nullable();
            $table->boolean('activo')->default(false);
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
        Schema::dropIfExists('addresses');
    }
}
