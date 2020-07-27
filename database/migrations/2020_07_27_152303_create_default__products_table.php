<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default__products', function (Blueprint $table) {
            $table->increments('default_product_id');
			$table->integer('product_id')->unsigned();
			$table->integer('unit_id')->unsigned();
			$table->decimal('sell_price', 10, 2)->default(0);
			$table->decimal('purchase_price', 10, 2)->default(0);
			$table->tinyInteger('isDeleted')->default(0);
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
        Schema::dropIfExists('default__products');
    }
}
