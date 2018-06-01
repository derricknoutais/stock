<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Voiture;
use App\Client;
use App\Payement;

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
        $contrats = Contrat::all()->sortBy('created_at');

        return view('contrats.index', compact('contrats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id = null)
    {
        $voitures = null;
        $clients = null;
        if($client_id){
            $voitures = Voiture::where('disponibilite', '=', 1)->get();
        } else {
            $voitures = Voiture::where('disponibilite', '=', 1)->get();
            $clients = Client::all();
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|integer',
            'voiture_id' => 'required|integer|max:255',
            'date_retour_prevue' => 'required|date' ,
            'caution' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return redirect('contrats/create')->withErrors($validator)->withInput();
        } else {
            if(Auth::check() ){
                $voitureDisponible = Voiture::find($request->input('voiture_id'));

                if($voitureDisponible->disponibilite){
                    $contrat = Contrat::create([
                        'client_id' => $request->input('client_id'),
                        'voiture_id' => $request->input('voiture_id'),
                        'date_retour_prevue' => Carbon::parse($request->input('date_retour_prevue'))->setTime(now()->hour,now()->minute, now()->second),
                        'caution' => $request->input('caution'),

                ]);
                    if($contrat){
                    $dispoVoiture = Voiture::where('id', $request->input('voiture_id'))->update([
                        'disponibilite' => 0
                    ]);
                    return redirect()->route('contrats.show', ['contrat'=> $contrat->id])->with('success', 'Contrat crée avec succes');
                } else {
                    return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du contrat');
                }
            } else {
                //return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du contrat');

            }
            }
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
        $payements = Payement::where('contrat_id', $contrat->id)->get();

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
            'client_id' => 'required|integer',
            'date_retour_prevue' => 'required|date' ,
            'caution' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return redirect('contrats/create') ->withErrors($validator)->withInput();
        } else {
            if(Auth::check() ){
                    if($request->input('date_retour_reelle')){
                        $retourner = true;
                    } else{
                        $retourner = false;
                    }
                    $contratUpdate = Contrat::where('id', $contrat->id)->update([
                        'voiture_id' => $contrat->voiture_id,
                        'client_id' => $request->input('client_id'),
                        'date_retour_prevue' => Carbon::parse($request->input('date_retour_prevue'))->setTime(now()->hour,now()->minute, now()->second),
                        'date_retour_reelle' => Carbon::parse($request->input('date_retour_reelle'))->setTime(now()->hour,now()->minute, now()->second),
                        'caution' => $request->input('caution'),
                ]);
                    if($contratUpdate && $retourner){
                        $retourVoiture = Voiture::where('id', $contrat->voiture_id)->update([
                            'disponibilite' => 1
                        ]);
                        return redirect()->route('contrats.show', ['contrat'=> $contrat->id])->with('success', 'Contrat modifié avec succes');
                    }

                } else {
                    return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du contrat');
                }
            }
        }


    public function retourner(Request $request,Contrat $contrat){

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
