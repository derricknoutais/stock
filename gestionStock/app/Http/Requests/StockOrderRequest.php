<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\StockOrder;
use App\PurchaseRequest;
use App\ProductStockOrder;

class StockOrderRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }
    public function persist()
    {
        $request = PurchaseRequest::find($this->input('request'));

        $order = StockOrder::create([
            'supplier_id' => $request->supplier_id,
            'purchase_request_id' => $this->input('request'),
            'user_id' => Auth::user()->id
        ]);
        PurchaseRequest::find($this->input('request'))->update([
            'stock_order_id' =>$order->id
        ]);
        $count = 0;
        foreach($request->products as $product){
            ProductStockOrder::create([
                'stock_order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'unit_price' => $this->input('unit_price' . $count),
                'imputation' => $this->input('imputation' . $count),
                'observation' => $this->input('observation' . $count),
                
            ]);
            $count++;
        }
        
        return $order;
        
    }
}
