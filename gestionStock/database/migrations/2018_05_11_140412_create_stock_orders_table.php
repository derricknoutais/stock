<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('purchase_request_id');
            $table->unsignedInteger('supplier_id');
            
            $table->boolean('daf_signed')->default(0);
            $table->boolean('dg_signed')->default(0);
            $table->smallInteger('state')->default(0);

            $table->double('custom')->default(0);
            $table->double('transport')->default(0);
            $table->double('otherFee')->default(0);

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stock_order_id')->references('id')->on('stock_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()

    {
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('stock_orders');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
