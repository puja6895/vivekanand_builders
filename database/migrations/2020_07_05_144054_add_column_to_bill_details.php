<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBillDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_details', function (Blueprint $table) {
            //
            $table->string('bill_no')->unique()->change();
            $table->double('due_amount',8,2)->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_details', function (Blueprint $table) {
            //
        });
    }
}
