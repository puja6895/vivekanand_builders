<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLorryReports extends Migration
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
            $table->integer('detain_days')->default(0)->after('rate');
            $table->double('detain_amount')->defalut(0)->after('detain_days');
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
