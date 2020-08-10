<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProductUnitIdSellProductPurchaseProductInvent extends Migration
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
            $table->string('productUnitId')->after('unit_id');
        });
        Schema::table('purchase_products', function (Blueprint $table) {
            $table->string('productUnitId')->after('unit_id');
        });
        Schema::table('invent', function (Blueprint $table) {
            $table->string('productUnitId')->after('unit_id');
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
