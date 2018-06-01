<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('purchaseRequest_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('purchaseRequest_id')->references('id')->on('purchase_requests')->onDelete('cascade');
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
        Schema::dropIfExists('product_purchase_requests');
    }
}
