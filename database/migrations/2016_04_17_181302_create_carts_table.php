<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('status');
            $table->integer('product_id');
            $table->string('product_sku')->nullable();
            $table->decimal('product_price', 10, 2)->unsigned();;
            $table->integer('qty')->unsigned();
            $table->date('checked_date')->nullable();
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
        Schema::drop('carts');
    }
}
