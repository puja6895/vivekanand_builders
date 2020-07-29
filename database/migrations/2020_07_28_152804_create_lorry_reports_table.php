<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLorryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lorry_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lorry_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('from');
            $table->string('to');
            $table->integer('unit_id')->unsigned();
            $table->double('weight',10,2)->default(0);
            $table->double('rate',10,2)->default(0);
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
        Schema::dropIfExists('lorry_reports');
    }
}
