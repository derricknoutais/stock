<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductSaleOrder;


class ProductSaleOrderController extends Controller
{
    public function store(Request $request)
    {

        $valid = $request->validate([
            'sale_order_id' => 'integer|min:1',
            'product_id' => 'integer|min:1',
            'quantity' => 'integer|min:1'
        ]);

        if($valid){
            $product = ProductSaleOrder::create([
                'sale_order_id' => $request->input('sale_order_id'),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity')
            ]);
            if($product){
                return redirect('bon-vente/'. $request->input('sale_order_id'));
            }
        }

    }
}
