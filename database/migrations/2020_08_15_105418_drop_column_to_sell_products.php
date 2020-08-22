<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToSellProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sell_products', function (Blueprint $table) {
            //
          $table->dropColumn('unit_name' , 'productUnitId');
        });

        Schema::table('purchase_products', function (Blueprint $table) {
            //
          $table->dropColumn( 'productUnitId');
        });

        Schema::table('invent', function (Blueprint $table) {
            //
          $table->dropColumn('productUnitId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sell_products', function (Blueprint $table) {
            //
        });
    }
}
