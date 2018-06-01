<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function stockOrders(){
        return $this->hasMany(StockOrder::class);
    }
    public function purchaseRequests(){
        return $this->hasMany(PurchaseRequest::class);
    }
}
