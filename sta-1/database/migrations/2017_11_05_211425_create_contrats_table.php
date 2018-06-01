<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('client_id')->unsigned();
            $table->integer('voiture_id')->unsigned();
            $table->integer('caution');

            $table->datetime('date_retour_prevue');
            $table->datetime('date_retour_reelle')->default('1000/11/23');

            $table->integer('somme_versee')->default(0);

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('voiture_id')->references('id')->on('voitures');

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
        Schema::dropIfExists('contrats');
    }
}
