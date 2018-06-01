<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Hbottp\Request;
use Charts;
use App\User;
use App\Role;
use App\Contrat;
use App\Voiture;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tauxLocation = Dashboard::tauxLocation();
        $locationMensuelle  = Dashboard::locationMensuelle();
        $locationJournaliere  = Dashboard::locationJournaliere();
        $payementMensuel = Dashboard::totalPayement();
        $nombreFacture = Dashboard::countLocation();
        $averageDay = Dashboard::averageTime();

        return view('dashboard.index', compact('tauxLocation', 'locationMensuelle', 'locationJournaliere', 'payementMensuel', 'nombreFacture', 'averageDay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
