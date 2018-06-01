<?php

namespace App\Http\Controllers;
use Charts;
use App\User;
use App\Role;
use App\Contrat;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $chart = Charts::create('pie', 'highcharts')
        //     ->title("Location par voiture")
        //     ->labels(["NS-979-DC","FG-987-BJ"])
        //     ->values([ 10,20 ]);


    }
}
