<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOrder extends Model
{
    protected $guarded = [];
    
    public function products(){
        return $this->belongsToMany(Product::class, 'product_stock_orders')->withPivot('quantity', 'unit_price', 'imputation', 'observation');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchaseRequest(){
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function montantTotal(){

        $total = 0;

        foreach ($this->products as $product) {

            $total += ( $product->total()) ;
        }
        return $total;

    }
}
