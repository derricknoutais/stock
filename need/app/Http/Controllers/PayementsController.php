<?php

namespace App\Http\Controllers;

use App\Payement;
use App\Contrat;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PayementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payements = Payement::all()->sortBy('created_at');
        return view('payements.index', compact('payements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contrats = Contrat::where('');
        return view('payements.create' , compact('contrats'));
    }
    public function create2($contrat_id = null)
    {

        if($contrat_id){
            $contrats = Contrat::where('id', $contrat_id)->get();
        }

        return view('payements.create' , compact('contrats'));
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
            'contrat_id' => 'required|integer',
            'versement' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect('contrats/create')->withErrors($validator)->withInput();
        } else {
            if(Auth::check() ){
                $contrat = Contrat::where('id', $request->input('contrat_id') )->first();

                $payement = Payement::create([
                    'contrat_id' => $request->input('contrat_id'),
                    'versement' => $request->input('versement'),
                ]);

                if($request->input('versement') > $contrat->voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay()) ){

                    $balance = Client::where('id', $request->input('client_id'))->update([
                        'balance' => $request->input('versement') - $contrat->voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay())
                    ]);
                }
                if($payement){
                    return redirect()->route('contrats.show', ['payement'=> $payement->contrat_id])->with('success', 'Contrat crée avec succes');
                } else {
                    return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du payement');
                }
            } else {
                return back()->withInput()->with('errors', 'Une erreur est survenue lors de la création du payement');
            }
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function show(Payement $payement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function edit(Payement $payement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payement $payement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payement  $payement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payement $payement)
    {
        //
    }
}
