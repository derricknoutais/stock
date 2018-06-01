<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    
    public function stockOrder()
    {
        return $this->belongsToMany(StockOrder::class);
    }

    public function purchaseRequests()
    {

        return $this->belongsToMany(PurchaseRequest::class);
    }

    public function value()
    {
        return $this->cost * $this->quantity;
    }

    public function totalValue()
    {
        return $this->value() + $this->customs + $this->others + $this->transport;
    }


    public function total(){
        return ($this->pivot->quantity * $this->pivot->unit_price);
    }

    public function currentStock(){
        $stock = 0;
        if($this->quantity){
            $stock = $this->quantity;
        } else {
            $stock = $this->stock_initial;
        }
        return $stock;
    }

    
}
