<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('inventory_id');
            $table->date('date');
			$table->integer('product_id');
            $table->integer('unit_id');
            $table->unique([
                'product_id',
                'unit_id',
                'date',
            ]);
			$table->decimal('stock', 8, 2);
			$table->tinyInteger('inventory_status')->default(1);
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
        Schema::dropIfExists('inventories');
    }
}
