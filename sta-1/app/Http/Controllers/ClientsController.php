<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $clients = Client::all()->sortBy("nom");
            return view('clients.index', compact('clients'));
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
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $client = Client::create([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'date_naissance' => $request->input('date_naissance'),
                'addresse' => $request->input('addresse'),
                'ville' => $request->input('ville'),
                'numero_permis' => $request->input('numero_permis'),
                'numero_phone' => $request->input('numero_phone'),
                'numero_phone2' => $request->input('numero_phone2'),
                'email' => $request->input('email'),

            ]);
             if($client){
                return redirect()->route('clients.show', ['client'=> $client->id])->with('success', 'Client crée avec succes');
            }
        }
        return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du nouveau client');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $client = Client::find($client->id);
        $contrats = Contrat::where('client_id', $client->id )->get();
        return view('clients.show', compact('client', 'contrats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $client = Client::find($client->id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if(Auth::check()){
            $clientUpdate = Client::where('id', $client->id)->update([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'date_naissance' => $request->input('date_naissance'),
                'addresse' => $request->input('addresse'),
                'ville' => $request->input('ville'),
                'numero_permis' => $request->input('numero_permis'),
                'numero_phone' => $request->input('numero_phone'),
                'numero_phone2' => $request->input('numero_phone2'),
                'email' => $request->input('email'),

            ]);
             if($clientUpdate){
                return redirect()->route('clients.show', ['client'=> $client->id])->with('success', 'Company created successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error Creating new Company');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $findClient = Client::find($client->id)->delete();
        if ($findClient) {
            return redirect()->route('clients.index')->with('success', 'Client Supprimé avec Succes');
        }
        return back()->withInput()->with('error', "Un problème est survenu. Le client n'a pu etre supprimé");
    }
}
