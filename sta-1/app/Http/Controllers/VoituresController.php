<?php

namespace App\Http\Controllers;

use App\Voiture;
use App\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class VoituresController extends Controller
{





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $voitures = Voiture::all()->sortBy("Immatriculation");
            return view('voitures.index', compact('voitures'));
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voitures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'immatriculation' => 'required|string|min:9|max:9',
            'marque' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'prix' => 'required|integer|min:6',
            'date_expiration_assurance' => 'required|date' ,
            'date_expiration_carte_grise' => 'required|date',
            'date_expiration_visite_technique' => 'required|date',
            'date_expiration_carte_extincteur' => 'required|date',
            'etat_voiture' => 'required',
            'pneu_secours' => 'required',
            'crick' => 'required',
            'boite_pharmacie' => 'required',
            'triangle' => 'required',
            'calle_metallique' => 'required',
            'cle_roue' => 'required',
            'gilet' => 'required',
            'baladeuse' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('voitures/create') ->withErrors($validator)->withInput();
        } else {
            if(Auth::check() ){
                $baladeuse = Input::has('baladeuse') ? true : false;
                $gilet = Input::has('gilet') ? true : false;
                $calle_metallique = Input::has('calle_metallique') ? true : false;
                $cle_roue = Input::has('cle_roue') ? true : false;
                $triangle = Input::has('triangle') ? true : false;
                $boite_pharmacie = Input::has('boite_pharmacie') ? true : false;
                $pneu_secours = Input::has('pneu_secours') ? true : false;
                $crick = Input::has('crick') ? true : false;
                $voiture = Voiture::create([
                    'immatriculation' => $request->input('immatriculation'),
                    'marque' => $request->input('marque'),
                    'type' => $request->input('type'),
                    'prix' => $request->input('prix'),
                    'date_expiration_assurance' => $request->input('date_expiration_assurance'),
                    'date_expiration_carte_grise' => $request->input('date_expiration_carte_grise'),
                    'date_expiration_visite_technique' => $request->input('date_expiration_visite_technique'),
                    'date_expiration_carte_extincteur' => $request->input('date_expiration_carte_extincteur'),
                    'etat_voiture' => $request->input('etat_voiture'),
                    'pneu_secours' => $pneu_secours,
                    'crick' => $crick,
                    'boite_pharmacie' => $boite_pharmacie,
                    'triangle' => $triangle,
                    'calle_metallique' => $calle_metallique,
                    'cle_roue' => $cle_roue,
                    'gilet' => $gilet,
                    'baladeuse' => $baladeuse,
                ]);
                if($voiture){
                    return redirect()->route('voitures.show', ['voiture'=> $voiture->id])->with('success', 'voiture crée avec succes');
                }
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function show(Voiture $voiture)
    {
        $voiture = Voiture::find($voiture->id);
        $contrats = Contrat::where('voiture_id', $voiture->id )->get();
        return view('voitures.show', compact('voiture', 'contrats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture)
    {
        $voiture = Voiture::find($voiture->id);
        return view('voitures.edit', compact('voiture') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture)
    {
        if(Auth::check() ){
            $baladeuse = Input::has('baladeuse') ? true : false;
            $gilet = Input::has('gilet') ? true : false;
            $calle_metallique = Input::has('calle_metallique') ? true : false;
            $cle_roue = Input::has('cle_roue') ? true : false;
            $triangle = Input::has('triangle') ? true : false;
            $boite_pharmacie = Input::has('boite_pharmacie') ? true : false;
            $pneu_secours = Input::has('pneu_secours') ? true : false;
            $crick = Input::has('crick') ? true : false;
            $voitureUpdate = Voiture::where('id', $voiture->id)->update([
                'immatriculation' => $request->input('immatriculation'),
                'marque' => $request->input('marque'),
                'type' => $request->input('type'),
                'prix' => $request->input('prix'),
                'date_expiration_assurance' => $request->input('date_expiration_assurance'),
                'date_expiration_carte_grise' => $request->input('date_expiration_carte_grise'),
                'date_expiration_visite_technique' => $request->input('date_expiration_visite_technique'),
                'date_expiration_carte_extincteur' => $request->input('date_expiration_carte_extincteur'),
                'etat_voiture' => $request->input('etat_voiture'),
                'pneu_secours' => $pneu_secours,
                'crick' => $crick,
                'boite_pharmacie' => $boite_pharmacie,
                'triangle' => $triangle,
                'calle_metallique' => $calle_metallique,
                'cle_roue' => $cle_roue,
                'gilet' => $gilet,
                'baladeuse' => $baladeuse,
            ]);
            if($voitureUpdate){
                return redirect()->route('voitures.show', ['voiture'=> $voiture->id])->with('success', 'voiture modifiée avec succes');
            }
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voiture $voiture)
    {
        $findVoiture = Voiture::find($voiture->id)->delete();
        if ($findVoiture) {
            return redirect()->route('voitures.index')->with('success', 'Voiture Supprimée avec Succes');
        }
        return back()->withInput()->with('error', 'Un problème est survenu la voiture n\'a pu etre supprimée');
    }
}
