<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Client;
use App\Voiture;
use App\Contrat;
use App\Payement;
use Carbon;

class PublishContratForm extends FormRequest
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
            'client_id' => 'required|integer',
            'voiture_id' => 'required|integer|max:255',
            'date_retour_prevue' => 'required|date' ,
            'caution' => 'integer|required',
            'remise' => 'integer'
        ];
    }
    public function persistContrat(){
        $voitureSelectionnée = Voiture::find($this->input('voiture_id'));
                if($voitureSelectionnée->disponibilite){
                    $client = Client::where('id', $this->input('client_id'))->first();
                    $contrat = Contrat::create([
                        'client_id' => $this->input('client_id'),
                        'voiture_id' => $this->input('voiture_id'),
                        'date_retour_prevue' => Carbon::parse($this->input('date_retour_prevue'))->setTime(now()->hour,now()->minute, now()->second),
                        'remise' => $this->input('remise'),
                        'created_at' => $this->input('created_at')
                    ]);
                    $caution = Client::where('id', $this->input('client_id'))->update([
                        'caution' => $client->caution + $this->input('caution')
                    ]);
                    if($contrat){
                        $dispoVoiture = Voiture::where('id', $this->input('voiture_id'))->update([
                            'disponibilite' => 0
                        ]);

                        $voiture = Voiture::where('id', $this->input('voiture_id'))->first();


                        $total = 0;

                        // $facturesClient = Contrat::where('client_id', '=', $this->input('client_id'))->get();
                        // foreach ($facturesClient as $fk) {
                        //     $payements = Payement::where('contrat_id', '=', $fk->id)->get();
                        //     foreach ($payements as $payement ) {
                        //         $total += $payement->versement;
                        //     }
                        // }



                        // $message = 'Merci ' . $client->nom . ' ' . $client->prenom . ' de nous faire confiance et de louer vos voitures avec STA.' . ' Les détails de votre nouveau contrat sont les suivants Immatriculation Voiture: '.  $voiture->immatriculation . ' Date de Retour: ' . $contrat->date_retour_prevue->format('d-M-Y') ;

                        // Contrat::envoiesMessage('24104727040', $message );
                        return $contrat;
                    }
            }
        }
    }
