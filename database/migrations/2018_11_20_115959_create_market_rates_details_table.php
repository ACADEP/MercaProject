<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketRatesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_rates_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('market_rates_id');
            $table->integer('product_id');
            $table->string('thumbnail');
            $table->integer('qty')->unsigned();
            $table->string('product_sku');
            $table->string('description');
            $table->decimal('price', 10, 2)->unsigned();
            $table->decimal('subtotal', 10, 2)->unsigned();
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
        Schema::dropIfExists('market_rates_details');
    }
}
