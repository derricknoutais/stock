@extends('layouts.app')

@section('content')
<div class="span3 well">
        <center>
        <a href="#product_view" data-toggle="modal" data-target="#product_view"><img src="https://imgct2.aeplcdn.com/img/800x600/car-data/big/maruti-suzuki-swift-default-image.png-version201710292106.png" name="aboutme" width="160" height="160" class="img-circle img-responsive"></a>
        <h3>{{ $voiture->immatriculation }}</h3>
        <p><em>{{ $voiture->marque . " " . $voiture->type }}</em></p>
        <a type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Faire Louer</a>
    </center>
</div>
<div class="col-xs-12 col-md-12 col">
    <div class="panel panel-primary ">
        <div class="panel-heading">
            contrats
            <a href="/contrats/create" class="pull-right btn btn-primary btn-sm" >Create New</a>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th>Facture Nº</th>
                      <th>Nom &amp; Prénom</th>
                      <th>Date de Retour</th>
                      <th>Total Facture</th>
                      <th>Total Versé</th>
                      <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contrats as $contrat)
                    @php
                        {{
                            Carbon::setlocale(LC_TIME, 'fr');
                            //$voiture = \App\Voiture::where('id' , '=', $contrat->voiture_id)->first();
                            $client = \App\Client::where('id' , '=', $contrat->client_id)->first();
                            $payements = \App\Payement::where('contrat_id', $contrat->id)->get();
                            $sommeVersee =0;
                            foreach ($payements as $payement) {
                                $sommeVersee += $payement->versement;
                            }
                            $total = $voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay());
                            //$balance = $sommeVersee - $voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay());

                        }}
                    @endphp
                    <tr>
                        <td>  {{$contrat->id }}</td>
                        <td> {{ $client->nom ." ". $client->prenom }}</td>
                        <td>@if ( $contrat->date_retour_reelle != '1000-11-23 00:00:00' )
                        Retourné
                        @else
                        {{ $contrat->date_retour_prevue }}
                        @endif</td>
                        <td>{{ number_format($total) }}</td>
                        <td>{{ $sommeVersee }}</td>
                        <td>{{ $sommeVersee - $total }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">{{ $voiture->marque . " " . $voiture->type }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="https://imgct2.aeplcdn.com/img/800x600/car-data/big/maruti-suzuki-swift-default-image.png-version201710292106.png" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>{{ $voiture->immatriculation }}</h4>
                        <p> {{ $voiture->etat_voiture }}</p>
                        <h3 class="cost">{{ number_format($voiture->prix, 0) }} F CFA</h3>
                        <div class="space-ten"></div>
                        <div class="btn-ground">
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Faire Louer</button>
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span> Voir Plus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
