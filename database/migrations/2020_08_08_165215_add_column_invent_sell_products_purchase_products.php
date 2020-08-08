<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInventSellProductsPurchaseProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sell_products', function (Blueprint $table) {
          
            $table->integer('unit_id')->unsigned()->after('product_id');
        });

        Schema::table('purchase_products', function (Blueprint $table) {
            
            // $table->dropColumn('unit_id');
            $table->integer('unit_id')->unsigned()->after('product_id')->change();
        });

        Schema::table('invent', function (Blueprint $table) {
            
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
        //
    }
}
