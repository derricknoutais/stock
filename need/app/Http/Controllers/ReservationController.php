<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request){

        $notification = new AnonymousNotifiable;
        $notification->route('mail', $request->email)->notify(new \App\Notifications\VoitureReservee($request));
        $notification->route('mail', 'stapog98@gmail.com')->notify(new \App\Notifications\VoitureReservee($request));
    }
}
