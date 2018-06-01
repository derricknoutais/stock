

@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-md-12 col">
    <div class="panel panel-primary ">
        <div class="panel-heading">
            contrats
            <a href="/contrats/create" class="pull-right btn btn-primary btn-sm">Create New</a>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
            <thead>
                <tr>
                  <th>Facture Nº</th>
                  <th>Nom &amp; Prénom</th>
                  <th>Immatriculation</th>
                  <th>Date de Retour</th>
                  <th>Balance</th>
                </tr>
            </thead>
            <tbody>

                    @foreach($contrats as $contrat)
                    @php
                        {{
                            Carbon::setlocale(LC_TIME, 'fr');
                            $voiture = \App\Voiture::where('id' , '=', $contrat->voiture_id)->first();
                            $client = \App\Client::where('id' , '=', $contrat->client_id)->first();
                            $payements = \App\Payement::where('contrat_id', $contrat->id)->get();
                            $sommeVersee =0;
                            $dateRetourReelle = $contrat->date_retour_reelle;
                            foreach ($payements as $payement) {
                                $sommeVersee += $payement->versement;
                            }
                            $balance = $sommeVersee - $voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay());

                        }}
                    @endphp

                        <tr @if( $contrat->date_retour_prevue->lt(now()) ) class="bg-danger" @else class="bg-success"  @endif />
                    <th scope="row"><a href="contrats/{{ $contrat->id }}">00{{ $contrat->id }}</a></th>
                    <td>
                        <a href="clients/{{ $client->id }}" title="">
                            {{ $client->nom }} {{ $client->prenom }}
                        </a>
                    </td>
                    <td>
                        <a href="voitures/{{ $voiture->id }}" title="">
                            {{ $voiture->immatriculation }}
                        </a>

                    </td>

                    <td>
                        @if( ($contrat->date_retour_reelle)->format('Y-m-d') != '1000-11-23' )
                            Retourné
                        @else

                            {{ Carbon::parse(($contrat->date_retour_prevue)->format('d-m-Y H:i:s'))->diffForHumans() }}
                        @endif
                    </td>
                    <td
                    @if ($balance < 0)
                        class="bg-warning"
                    @endif>{{ number_format($balance) }}</td>
                    <td>
                        <a  class="btn btn-primary btn-sm" @if ($balance>=0)
                            disabled="disabled"
                            href="#"
                        @else
                            href="payements/create/{{ $contrat->id }}"
                        @endif >Créer un payement</a>

                        <a href="contrats/{{ $contrat->id }}/edit" class="btn btn-primary btn-sm">Editer</a>

                        <a href="#" type="button" class="btn btn-primary btn-sm" onclick="var result = confirm('Etes vous sur de vouloir supprimer un client?');
                            if(result){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                            }" >Supprimer</a>
                            <form id="delete-form" action="{{ route('contrats.destroy' , [$contrat->id]) }}" method="POST" style="display: none;">
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}
                            </form>

                            <a type="button" class="btn btn-primary btn-sm"
                                @if( ($contrat->date_retour_reelle)->format('Y-m-d') != '1000-11-23' )
                                    disabled="disabled"
                                    href="#"
                                @else
                                    href="contrats/edit/{{ $contrat->id }}"
                                @endif
                            >Retourner</a>
                       <form id="retour-form" action="{{ route('contrats.update' , [$contrat->id]) }}" method="POST" style="display: none;">
                               <input type="hidden" name="_method" value="put">
                               {{ csrf_field() }}
                               <input type="date" name="date_retour_reelle" value="{{ Carbon::now()->format('Y-m-d')  }}">
                               <input type="text" name="client_id" value="{{ $contrat->id }}">
                               <input type="date" name="date_retour_prevue" value="{{ ($contrat->date_retour_prevue)->format('Y-m-d') }}">
                               <input type="" name="caution" value="{{ $contrat->caution }}">
                               <input type="submit" name="">
                       </form>
                    </td>

                </tr>
                </a>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
