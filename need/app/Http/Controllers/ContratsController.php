<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Voiture;
use App\Client;
use App\Payement;
use Calendar;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;
use DB;

class ContratsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = Contrat::all();

        return view('contrats.index', compact('contrats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id = null){
        $voitures = null;
        $clients = null;
        if($client_id){
            $voitures = Voiture::where('disponibilite', '=', 1)->get()->sortBy('immatriculation');
        } else {
            $voitures = Voiture::where('disponibilite', '=', 1)->get()->sortBy('immatriculation');
            $clients = Client::all()->sortBy('nom');
        }

        return view('contrats.create' ,['voitures' => $voitures , 'clients' => $clients, 'client_id'=>$client_id]);
    }

    public function create2($voiture_id = null )
    {
        $voitures = null;
        if($voiture_id){
            $clients = Client::all();
        }
        return view('contrats.create' , compact('voitures','clients', 'voiture_id') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\Http\Requests\PublishContratForm $form)
    {
        $contrat = $form->persistContrat();
        if($contrat){
            return redirect()->route('contrats.show', ['contrat'=> $contrat->id])->with('success', 'Contrat crée avec succes');
        } else {
            return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du contrat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function show(Contrat $contrat)
    {
        $today = getDate();
        $payements = Payement::where('contrat_id', $contrat->id)->sum('versement');
        $contrat = Contrat::find($contrat->id);

        return view('contrats.show' , compact('contrat', 'payements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrat $contrat)
    {
        $contrat = Contrat::find($contrat->id);
        $voitures = Voiture::all();
        $clients = Client::all();

        return view('contrats.edit', compact('contrat', 'voitures', 'clients'));
    }
    public function edit2($contrat_id = null)
    {
        $contrat = null;
        if($contrat_id){
            $contrat = Contrat::find($contrat_id);
            $voitures = Voiture::all();
            $clients = Client::all();
        }
        return view('contrats.retourner', compact('contrat', 'voitures', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrat $contrat)
    {
        $validator = Validator::make($request->all(), [
            'voiture_id' => 'required|integer',
            'client_id' => 'required|integer',
            'date_retour_prevue' => 'required|date' ,
        ]);
        if ($validator->fails()) {
            return redirect('contrats/create')->withErrors($validator)->withInput();
        } else {
            $contratUpdate = Contrat::where('id', $contrat->id)->update([
                'voiture_id' => $request->input('voiture_id'),
                'client_id' => $request->input('client_id'),
                'date_retour_prevue' => Carbon::parse($request->input('date_retour_prevue'))->setTime(now()->hour,now()->minute, now()->second),
            ]);
            $cautionUpdate = Client::where('id', $contrat->client_id)->update([
                'caution' => $request->caution
            ]);
            if ($contratUpdate && $cautionUpdate) {
                return redirect('/contrats');
            }
        }
    }

    public function retourner(Request $request, $contrat_id){
        $contrat = Contrat::find($contrat_id);

        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer',
            'date_retour_reelle' => 'required|date' ,
            'caution' => 'integer|required'
        ]);
        if($validator->fails()){
            return redirect('/contrats/retourner')->withErrors($validator)->withInput();
        } else {
            $client = Client::find($contrat->client_id);
            $retourContrat = Contrat::where('id', $contrat->id)->update([
                'date_retour_reelle' => Carbon::parse($request->input('date_retour_reelle'))->setTime(now()->hour,now()->minute, now()->second),
            ]);
            $retourContrat = Client::where('id', $contrat->client_id)->update([
                'caution' => ($client->caution - $request->input('caution')),
            ]);
            $retourVoiture = Voiture::where('id', $contrat->voiture_id)->update([
                'disponibilite' => 1
            ]);
            return redirect('/contrats')->withSuccess('Voiture Retournée');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrat  $contrat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrat $contrat)
    {
        $findContrat = Contrat::find($contrat->id)->delete();
        if ($findContrat) {
            return redirect()->route('contrats.index')->with('success', 'Contrat Supprimée avec Succes');
        }
        return back()->withInput()->with('error', 'Un problème est survenu la contrat n\'a pu etre supprimée');
    }
}
