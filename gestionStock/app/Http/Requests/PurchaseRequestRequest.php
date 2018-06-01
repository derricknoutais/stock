<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\PurchaseRequest;

class PurchaseRequestRequest extends FormRequest
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
            'type' => 'required|integer|min:0|max:1',
            'supplier' => 'required|integer',
            'observation' => 'string',
            'object' => 'string'
            
        ];
    }
    public function persist()
    {
        
        $order = PurchaseRequest::create([
            'object' => $this->input('object'),
            'observation' => $this->input('observation'),
            'supplier_id' => $this->input('supplier'),
            'user_id' => Auth::user()->id
        ]);

        

        if($order){
            if($this->input('type') == 0){
                $count = PurchaseRequest::whereNotNull('local_id')->count();
                PurchaseRequest::find($order->id)->update([
                    'local_id' => ($count + 1)
                ]);
            } else if($this->input('type') == 1){
                $count = PurchaseRequest::whereNotNull('international_id')->count();
                PurchaseRequest::find($order->id)->update([
                    'international_id' => ($count + 1)
                ]);
            }
            
        }
        
        
        return $order;
    }
}
