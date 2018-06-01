<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $guarded = [];
    
    public function products(){

        return $this->belongsToMany(Product::class, 'product_purchase_requests' , 'purchaseRequest_id')->withPivot('quantity')->withTimeStamps();
    }

    public function stockOrder(){
        return $this->hasOne(StockOrder::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
