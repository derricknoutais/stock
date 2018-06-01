<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\ProductStockOrder;

class AddProductsToOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'customs' => 'required|integer',
            'transport' => 'required|integer',
            'otherCost' => 'required|integer',
        ];
    }

    public function persist()
    {
        $product_order = ProductStockOrder::create([
            'stock_order_id' => $this->input('order_id'),
            'product_id' => $this->input('product_id'),
            'customs' => $this->input('customs'),
            'transport' => $this->input('transport'),
            'quantity' => $this->input('quantity'),
            'otherCost' => $this->input('otherCost')
        ]);

        return $product_order;
    }
}
