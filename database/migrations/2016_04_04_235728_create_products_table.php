<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('product_name');
            $table->integer('product_qty')->nullable();
            $table->string('product_sku')->nullable();
            $table->integer('product_manufacturer')->unsigned()->nullable();
            $table->integer('guaranty')->unsigned()->nullable();
            $table->dateTime('date_prom')->nullable();
            $table->decimal('price', 10, 2)->unsigned();
            $table->decimal('reduced_price', 10, 2)->unsigned()->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('cat_id')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned()->nullable();

            $table->integer('weight')->unsigned()->nullable();
            $table->integer('length')->unsigned()->nullable();
            $table->integer('height')->unsigned()->nullable();
            $table->integer('width')->unsigned()->nullable();

            $table->integer('featured')->default(0);
            $table->text('description')->nullable();
            $table->text('product_spec')->nullable();
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
        Schema::drop('products');
    }
}
