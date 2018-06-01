<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB; 

class AddProductsToPurchaseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'purchaseRequest_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function persist(){

        DB::table('product_purchase_requests')->insert([
            'purchaseRequest_id' => $this->input('purchaseRequest_id'),
            'product_id' => $this->input('product_id'),
            'quantity' => $this->input('quantity'),
        ]);
        
    }
}
