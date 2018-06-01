<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('immatriculation');
            $table->string('marque');
            $table->string('type');
            $table->integer('prix');
            $table->date('date_expiration_assurance');
            $table->date('date_expiration_carte_grise');
            $table->date('date_expiration_visite_technique');
            $table->date('date_expiration_carte_extincteur');
            $table->longText('etat_voiture');
            //$table->boolean('accessoires')->default(1);
            $table->boolean('pneu_secours');
            $table->boolean('crick');
            $table->boolean('boite_pharmacie');
            $table->boolean('triangle');
            $table->boolean('calle_metallique');
            $table->boolean('cle_roue');
            $table->boolean('gilet');
            $table->boolean('baladeuse');
            $table->boolean('disponibilite')->default(1);
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
        Schema::dropIfExists('voitures');
    }
}
