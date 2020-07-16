<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasers', function (Blueprint $table) {
            $table->increments('purchaser_id');
            $table->string('purchaser_name');
            $table->string('company')->nullable();
            $table->string('purchaser_mobile');
            $table->string('purchaser_email')->nullable();
            $table->string('purchaser_address')->nullable();
            $table->tinyinteger('isDeleted')->default('0');
            // $table->tinyInteger('purchaser_status')->default(1);
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
        Schema::dropIfExists('purchasers');
    }
}
