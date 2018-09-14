<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('date');
            $table->string("product_name");
            $table->decimal('product_price', 10, 2)->unsigned();
            $table->integer('amount');
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
        Schema::dropIfExists('customer_histories');
    }
}
