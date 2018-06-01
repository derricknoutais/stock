<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->nullable();
            $table->integer('international_id')->nullable();

            $table->unsignedInteger('stock_order_id')->nullable();
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('user_id');

            $table->text('observation');
            $table->text('object');

            $table->smallInteger('state')->default(0);
            $table->boolean('saved')->default(false);
            
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('purchase_requests');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
