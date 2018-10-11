<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->dateTime("date");
            $table->string("url_fact");
            $table->string("shipment_method")->nullable();
            $table->string("status_pago");
            $table->string("status_envio");
            $table->string("status_reclamo");
            $table->string("reclame_text")->nullable();
            $table->string("respond_reclame")->nullable();
            $table->dateTime("date_reclame")->nullable();
            $table->decimal('total', 10, 2)->unsigned();
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
        Schema::dropIfExists('sales');
    }
}
