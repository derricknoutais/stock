<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('stock_order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');

            $table->double('unit_price');
            $table->double('unit_cost')->nullable();

            $table->string('imputation');
            $table->string('observation');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('stock_order_id')->references('id')->on('stock_orders')->onDelete('cascade');
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
        Schema::dropIfExists('product_stock_orders');
    }
}
