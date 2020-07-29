<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndAddColumnDateToLorryReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lorry_reports', function (Blueprint $table) {
            //
            $table->dropColumn('sell_date');
            $table->date('lorry_date')->after('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lorry_reports', function (Blueprint $table) {
            //
        });
    }
}
