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
            $table->string('calles')->nullable();
            $table->string('numInterior')->default(''); 
            $table->string('numExterior')->nulable();
            $table->text('referencias')->nullable();
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
