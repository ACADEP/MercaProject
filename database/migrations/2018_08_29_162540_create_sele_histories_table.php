<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSeleHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sele_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer("sale_id");
            $table->integer('product_id');
            $table->string('client');
            $table->date('date');
            $table->integer('amount')->unsigned();
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
        Schema::dropIfExists('sele_histories');
    }
}
