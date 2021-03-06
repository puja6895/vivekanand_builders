<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GstSellProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
        //
        public function up()
    {
        Schema::create('gst_sell_products', function (Blueprint $table) {
            $table->increments('gst_sell_products_id');
            $table->integer('gst_sell_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('unit_name');
            $table->integer('quantity');
            $table->double('rate',10,2);
            $table->float('gst',10,2)->default(0);
            $table->double('amount',10,2)->default(0);
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
