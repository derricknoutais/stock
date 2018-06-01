<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'addresse',
        'ville',
        'numero_permis',
        'numero_phone',
        'numero_phone2',
        'email'
    ];
    public function contrats(){
        return $this->hasMany('App\Contract');
    }
}
