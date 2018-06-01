@extends('layouts.app')

@section('content')
@php
    {{
        Carbon::setLocale('fr');
        $voiture = \App\Voiture::where('id' , '=', $contrat->voiture_id)->first();
        $client = \App\Client::where('id' , '=', $contrat->client_id)->first();

    }}
@endphp
<div class="container">
    <div class="row pad-top-botm ">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <img src="https://scontent.fauh1-1.fna.fbcdn.net/v/t1.0-9/19884087_166912523851010_9069674227465647267_n.png?oh=6a25a062cc7554ad975c8426deeb7fa2&oe=5A69312F" style="padding-bottom:20px;" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:5em;">

               <strong>Services Tous Azimuts </strong>
              <br />
                  Rue Frédéric Dionni, Ngady a la Case D'écoute
              <br />
                  B.P:1268 Port-Gentil (Gabon)
              <br />
                <strong>Email : </strong>  servicestousazimuts@hotmail.fr
            <br />
                <strong>Phone : </strong>  (+241) 07 15 82 15 / (+241) 06 26 82 75


         </div>
     </div>
     <div  class="row  contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12 text-center">
             <hr />
             <h1>Contrat Nª 00{{ $contrat->id }}</h1>
             <hr />
         </div>
     </div>
     <div  class="row pad-top-botm client-info">
         <div class="col-lg-4 col-md-4 col-sm-4">
         <h4>  <strong>Information Client</strong></h4>
           <strong>{{ $client->prenom . " " . $client->nom }}</strong>
             <br />
                <b>Phone :</b>{{ $client->numero_phone }} @if($client->numero_phone2 != "") / {{ $client->numero_phone2  }} @endif
             <br />
                  <b>Address :</b>{{ $client->addresse }}
              <br />
                 {{ $client->ville }}


              <br />
             <b>E-mail :</b>{{ $client->email  }}
         </div>
        <div class="col-lg-4 col-md-4 col-sm-4">

        </div>
          <div class="col-lg-4 col-md-4 col-sm-4">

        	<h4>  <strong>Details de Payement </strong></h4>
        	<strong>Date :</strong> {{ ($contrat->created_at)->format('d-M-Y') . " @ " .  ($contrat->created_at)->format('H:i:s') }}
            <br />
            <b>Total Facture :  {{ number_format($voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay()), 0) }} F CFA</b>
              <br />
            @php
            $somme =0;
              foreach ($payements as $payement) {
                $somme += $payement->versement;
              }
            @endphp
            <b>Somme Versée: </b> {{ number_format($somme, 0) }} F Cfa

              <br />
              <p><b>Caution:</b>{{ number_format($contrat->caution,0) }} F Cfa</p>
         </div>
     </div>
     <hr>
    <div class="row">
        <h4 class="text-center">  <strong>Information Voiture</strong> </h4>
        <div class="col-md-6">
            <div class="text-center ">
                <h4 class="">Détails</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <b>Immatriculation :</b>{{ $voiture->immatriculation }}
                <br />
                <b>Marque :</b>{{ $voiture->marque . " " . $voiture->type  }}
                <br />
                <b>Prix Journalier :</b>{{ number_format($voiture->prix, 0) . " F Cfa"}}
                <br />
                <b>Type Carburant:</b> Essence
                <br />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <b>Assurance :</b> {{ $voiture->date_expiration_assurance->format('d-M-Y')  }}
                <br />
                <b>A.P de Circuler :</b> {{ $voiture->date_expiration_carte_grise->format('d-M-Y')   }}
                <br />
                <b>Visite Technique :</b> {{ $voiture->date_expiration_visite_technique->format('d-M-Y') }}
                <br />
                <b>Carte Extincteur:</b> {{ $voiture->date_expiration_carte_extincteur->format('d-M-Y')  }}
                <br />
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-center ">
                <h4 class="">Accessoires</h4>
            </div>
            <div class="form-check col-md-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->pneu_secours)
                            checked
                        @endif
                    > Pneus Secours
                </label>
            </div>
            <div class="form-check col-md-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->crick)
                            checked
                        @endif
                    > Crick
                </label>
            </div>
            <div class="form-check col-md-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->boite_pharmacie)
                            checked
                        @endif
                    > Boîte Pharmacie
                </label>
            </div>
            <div class="form-check col-md-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->calle_metallique)
                            checked
                        @endif
                    > Calle Métallique
                </label>
            </div>
            <div class="form-check col-md-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->triangle)
                            checked
                        @endif
                    > Triangle
                </label>
            </div>
            <div class="form-check col-md-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->cle_roue)
                            checked
                        @endif
                    > Clé à Roue
                </label>
            </div>
            <div class="form-check col-md-4">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->baladeuse)
                            checked
                        @endif
                    > Baladeuse
                </label>
            </div>
            <div class="form-check col-md-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                        @if ($voiture->gilet)
                            checked
                        @endif
                    > Gilet
                </label>
            </div>
        </div>

    </div>

     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">

             <hr />
             <div class="ttl-amts">
               <h5>  Montant Total : {{ number_format($voiture->prix * (($contrat->created_at)->startOfDay())->diffInDays(($contrat->date_retour_prevue)->startOfDay()), 0) }} F Cfa</h5>
             </div>
             <hr />
              <div class="ttl-amts">
                  <h5><b>Caution:</b> {{ number_format($contrat->caution,0) }} F Cfa</h5>
             </div>
             <hr />
              <div class="ttl-amts">
                  <h4><b>Somme Versée: </b> {{ number_format($somme, 0) }} F Cfa </h4>
             </div>
         </div>
     </div>
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <strong> Important: </strong>
             <ol>
                  <li>
                    La caution n'est remboursable que si le véhicule est rendu dans le même état que cité ci-dessus

                 </li>
                 <li>
                    Le carburant est à la charge du client. La voiture est de type essence. L'utilisation de carburant autre que celle des stations de service entrainera un non-retrait de caution
                 </li>
                 <li>
                     Seul l
                 </li>
             </ol>
             </div>
         </div>
      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <a href="#" class="btn btn-primary btn-lg" >Print Invoice</a>
             &nbsp;&nbsp;&nbsp;
              <a href="#" class="btn btn-success btn-lg" >Download In Pdf</a>

             </div>
         </div>
 </div>
@endsection
