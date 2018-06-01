<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Voiture;
use Illuminate\Support\Facades\Input;
class PublishVoitureForm extends FormRequest
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
            'immatriculation' => 'unique:voitures|required|string|min:9|max:9',
            'marque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'prix' => 'required|integer|min:6',
            'date_expiration_assurance' => 'nullable|date' ,
            'date_expiration_carte_grise' => 'nullable|date',
            'date_expiration_visite_technique' => 'nullable|date',
            'date_expiration_carte_extincteur' => 'nullable|date',
            'etat_voiture' => 'nullable',
            'pneu_secours' => 'nullable',
            'crick' => 'nullable',
            'boite_pharmacie' => 'nullable',
            'triangle' => 'nullable',
            'calle_metallique' => 'nullable',
            'cle_roue' => 'nullable',
            'gilet' => 'nullable',
            'baladeuse' => 'nullable'
        ];
    }
    public static function collecteInfoSurAccessoire(){
        $baladeuse = Input::has('baladeuse') ? true : false;
        $gilet = Input::has('gilet') ? true : false;
        $calle_metallique = Input::has('calle_metallique') ? true : false;
        $cle_roue = Input::has('cle_roue') ? true : false;
        $triangle = Input::has('triangle') ? true : false;
        $boite_pharmacie = Input::has('boite_pharmacie') ? true : false;
        $pneu_secours = Input::has('pneu_secours') ? true : false;
        $crick = Input::has('crick') ? true : false;

        return $accessoires = compact('baladeuse', 'gilet', 'calle_metallique', 'cle_roue', 'triangle', 'boite_pharmacie', 'pneu_secours', 'crick');
    }
    public static function creeVoiture($that){
        $accessoires = PublishVoitureForm::collecteInfoSurAccessoire();
        return $voiture = Voiture::create([
                'immatriculation' => $that->input('immatriculation'),
                'marque' => $that->input('marque'),
                'type' => $that->input('type'),
                'prix' => $that->input('prix'),
                'date_expiration_assurance' => $that->input('date_expiration_assurance'),
                'date_expiration_carte_grise' => $that->input('date_expiration_carte_grise'),
                'date_expiration_visite_technique' => $that->input('date_expiration_visite_technique'),
                'date_expiration_carte_extincteur' => $that->input('date_expiration_carte_extincteur'),
                'etat_voiture' => $that->input('etat_voiture'),

                'pneu_secours' => $accessoires['pneu_secours'],
                'crick' => $accessoires['crick'],
                'boite_pharmacie' => $accessoires['boite_pharmacie'],
                'triangle' => $accessoires['triangle'],
                'calle_metallique' => $accessoires['calle_metallique'],
                'cle_roue' => $accessoires['cle_roue'],
                'gilet' => $accessoires['gilet'],
                'baladeuse' => $accessoires['baladeuse'],
            ]);
    }
    public function persist(){
        return $voiture = PublishVoitureForm::creeVoiture($this);
    }
}
