<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $fillable = ['contrat_id' , 'versement' ];
    protected $dates = ['created_at, updated_at'];

    public function contrats(){
        return $this->belongsTo('App\Contrat');
    }
}
