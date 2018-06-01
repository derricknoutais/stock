<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_products', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->double('cost');
            $table->double('quantity');
            $table->enum('conditioning',[
                'C24X1L','C4X5L','C6X4L','C12X1L','FUTS', 'VRAC'
            ]);
            $table->double('conditioning_weight');
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
        Schema::dropIfExists('final_products');
    }
}
