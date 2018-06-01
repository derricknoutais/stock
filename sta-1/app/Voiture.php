<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    protected $fillable = [
        "immatriculation",
        "marque",
        "type",
        "prix",
        'date_expiration_assurance',
        'date_expiration_carte_grise',
        'date_expiration_visite_technique',
        'date_expiration_carte_extincteur',
        'etat_voiture',
        'accessoires',
        'pneu_secours',
        'crick',
        'boite_pharmacie',
        'triangle',
        'calle_metallique',
        'cle_roue',
        'gilet',
        'baladeuse'
    ];
    protected $dates = ['created_at', 'updated_at', 'date_expiration_carte_extincteur', 'date_expiration_assurance', 'date_expiration_visite_technique', 'date_expiration_carte_grise'];
    public function contracts(){
        return $this->hasMany('App\Contract');
    }
}
