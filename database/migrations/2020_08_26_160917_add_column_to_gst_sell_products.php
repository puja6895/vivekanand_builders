<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToGstSellProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gst_sell_products', function (Blueprint $table) {
            //
            $table->dropColumn('unit_name');
            $table->integer('unit_id')->unsigned()->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gst_sell_products', function (Blueprint $table) {
            //
        });
    }
}
