<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalProduct extends Model
{
    public function value()
    {
        return $this->cost * $this->quantity;
    }
}
