<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientsController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $clients = Client::all()->sortBy("nom");
            return view('clients.index', compact('clients'));
        }
        return view('auth.login');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(\App\Http\Requests\PublishCustomerForm $form)
    {
        $clientCréé = $form->persist();
        if($clientCréé){
            return redirect()->route('clients.show', ['client'=> $clientCréé->id])->with('success', 'Client créé avec succes');
        } else {
            return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du nouveau client');
        }

    }

    public function show(Client $client)
    {
        $client = Client::find($client->id);
        $contrats = Contrat::where('client_id', $client->id )->get();
        return view('clients.show', compact('client', 'contrats'));
    }

    public function edit(Client $client)
    {
        $client = Client::find($client->id);
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client, \App\Http\Requests\PublishCustomerForm $form)
    {
        $form->persistUpdate($client);
    }

    public function destroy(Client $client)
    {
        $findClient = Client::find($client->id)->delete();
        if ($findClient) {
            return redirect()->route('clients.index')->with('success', 'Client Supprimé avec Succes');
        }
        return back()->withInput()->with('error', "Un problème est survenu. Le client n'a pu etre supprimé");
    }
}
