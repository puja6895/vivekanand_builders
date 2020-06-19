<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SellPayAmounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sell_payAmounts', function (Blueprint $table) {
            $table->increments('pay_amount_id');
            $table->integer('customer_id')->unsigned();
            $table->date('pay_date');
            $table->string('pay_mode');
            $table->float('pay_received',10,2)->default(0);
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
