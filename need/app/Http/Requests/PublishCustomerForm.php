<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Client;
class PublishCustomerForm extends FormRequest
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
    public function rules(){
        return [
            'nom' => 'required',
            'prenom' => 'nullable',
            'date_naissance' => 'nullable',
            'addresse' => 'nullable',
            'ville' => 'nullable',
            'numero_permis' => 'nullable',
            'numero_phone' => 'nullable',
            'numero_phone2' => 'nullable',
            'email' => 'nullable'
        ];
    }
    public function persist(){
            return $client = Client::create([
                'nom' => $this->input('nom'),
                'prenom' => $this->input('prenom'),
                'date_naissance' => $this->input('date_naissance'),
                'addresse' => $this->input('addresse'),
                'type' => $this->input('type'),
                'ville' => $this->input('ville'),
                'numero_permis' => $this->input('numero_permis'),
                'numero_phone' => $this->input('numero_phone'),
                'numero_phone2' => $this->input('numero_phone2'),
                'email' => $this->input('email'),
            ]);
    }
    public function persistUpdate(Client $client){
        $clientUpdate = Client::where('id', $client->id)->update([
            'nom' => $this->input('nom'),
            'prenom' => $this->input('prenom'),
            'date_naissance' => $this->input('date_naissance'),
            'addresse' => $this->input('addresse'),
            'ville' => $this->input('ville'),
            'numero_permis' => $this->input('numero_permis'),
            'numero_phone' => $this->input('numero_phone'),
            'numero_phone2' => $this->input('numero_phone2'),
            'email' => $this->input('email')

        ]);
         if($clientUpdate){
            return redirect()->route('clients.show', ['client'=> $client->id])->with('success', 'Company created successfully');
        }
        return back()->withInput()->with('errors', 'Error Creating new Company');
    }

}
