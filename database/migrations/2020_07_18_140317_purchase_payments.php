<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchasePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('purchase_payments', function (Blueprint $table) {
            $table->increments('purchase_payment_id');
            $table->integer('purchase_id')->unsigned();
            $table->date('paid_date');
            $table->string('paid_mode');
            $table->float('debit')->default(0);
            $table->float('credit')->default(0);
            $table->double('paid',10,2)->default(0);
            $table->double('final_paid',10,2)->default(0);
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
