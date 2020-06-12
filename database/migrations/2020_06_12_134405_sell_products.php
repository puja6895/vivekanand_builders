<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SellProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_products', function (Blueprint $table) {
            $table->increments('sell_products_id');
            $table->integer('sell_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('unit_name');
            $table->integer('quantity');
            $table->double('rate',10,2);
            $table->float('gst',10,2)->default(0);
            $table->double('total_amount',10,2);
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
        //
    }
}
