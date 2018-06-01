@extends('layouts.app')

@section('content')

    @include('partials.header')

    <div class="text-center my-5">
        <a name="" id="" class="btn btn-danger" href="/bon-achat" role="button">Retour</a>

        @if( ! $order->dg_signed && !$order->daf_signed )
        <a name="" id="" class="btn btn-success" href="/bon-commande/{{$order->id}}/daf-valide" role="button">D.A.F Valider</a>
        @endif

        @if($order->daf_signed && ! $order->dg_signed )
        <a name="" id="" class="btn btn-success" href="/bon-commande/{{$order->id}}/dg-valide" role="button">D.G Valide</a>
        @endif

        @if($order->custom)
            <a name="" id="" class="btn btn-success" href="/bon-commande/{{$order->id}}/recevoir-stock" role="button">Recevoir Stock</a>
        @endif

    </div>

    <a class="btn btn-primary" data-toggle="collapse" href="#plusdinfos" role="button" aria-expanded="false" aria-controls="collapseExample">
        Informations Supplémentaires
    </a>
    @if($order->daf_signed && $order->dg_signed)
    <a class="btn btn-primary" data-toggle="collapse" href="#inputFees" role="button" aria-expanded="false" aria-controls="collapseExample">
        Entrer Frais
    </a>
    @endif
    <div class="collapse mb-2" id="plusdinfos">
        <div class="card card-body">
        <p>Approbations: 
            @if($order->daf_signed && $order->dg_signed)
                Approuvé (2/2)
            @elseif($order->daf_signed || $order->dg_signed)
                En Cours d'Approbation (1/2)
            @else 
                En Attente d'Approbation (0/2)
            @endif
        </p>
        <p>D.A Correspondante:<a href="/demande-achat/{{$order->purchaseRequest->id}}">
            @if($order->purchaseRequest->local_id)
                ACL00{{$order->purchaseRequest->local_id}}/{{($order->purchaseRequest->created_at)->format('Y')}}
            @else
                ACE00{{$order->purchaseRequest->international_id}}/{{($order->purchaseRequest->created_at)->format('Y')}}
            @endif
        </a></p>
        <p>Fournisseur Retenu: {{$order->supplier->name}}</p>
        <p>Nom Émetteur:</p>


        </div>
    </div>
    
    <div class="collapse mb-2" id="inputFees">
        <div class="card card-body">
            <form method="POST" action="/bon-commande/{{$order->id}}/frais" class="col-md-6 offset-md-4 text-center">
                @csrf
                <div class="form-group">
                  <label for="">Frais de Douanes</label>
                  <input type="text" class="form-control" name="custom" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Frais de Transport</label>
                  <input type="text" class="form-control" name="transport" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Frais Divers</label>
                  <input type="text" class="form-control" name="otherFee" id="" aria-describedby="helpId" placeholder="">
                </div>
                <button type="submit" class="btn btn-success text-center">Enregistrer</button>
            </form>
        </div>
    </div>

    <h1 class="my-5">Bon de Commande Nº {{$order->id}}</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Désignation</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Total</th>
                <th scope="col">Imputation</th>
                <th scope="col">Observations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <th scope="row"><a href="/produits/{{$product->name}}">{{$product->name}}</a></th>
                <td>{{$product->pivot->quantity}}</td>
                <td>@money($product->pivot->unit_price)</td>
                <td>@money($product->total())</td>
                <td>{{$product->pivot->imputation}}</td>
                <td>{{$product->pivot->observation}}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><strong>Total</strong></td>
                <td><strong>@money($order->montantTotal())</strong></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="row my-5">
        <div class="col-md-4">
            <p class="">Port-Gentil, le {{$order->created_at->format('d-M-Y')}}</p>
        </div>
        <div class="col-md-4 text-center">
            <p>D.A.F</p>
        </div>
        <div class="col-md-4 text-right">
            <p>Direction Générale</p>
        </div>
    </div>
@endsection