@extends('layouts.app') 

@section('content')

@include('partials.header')

@if( ! $purchaseRequest->saved)
        <a class="btn btn-primary" data-toggle="collapse" href="#ajout" role="button" aria-expanded="false" aria-controls="collapseExample">
            Ajouter Des Produits
        </a>
@endif
        <a class="btn btn-primary" data-toggle="collapse" href="#plusdinfos" role="button" aria-expanded="false" aria-controls="collapseExample">
            Informations Supplémentaires
        </a>
@if($purchaseRequest->saved && !$purchaseRequest->stock_order_id)
    <a class="btn btn-primary" href="/bon-commande/nouveau/{{$purchaseRequest->id}}" role="button">
        Créer Bon de Commande Correspondant
    </a>
@endif


    <div class="collapse mb-2" id="plusdinfos">
        <div class="card card-body">
        <p>État: @state($purchaseRequest->state)</p>
        @if($purchaseRequest->stockOrder)
            <p>B.C Correspondant: <a href="/bon-commande/{{$purchaseRequest->stockOrder->id}}">{{$purchaseRequest->stockOrder->id}}</a></p>
        @endif
        <p>Fournisseur Retenu: {{$purchaseRequest->supplier->name}}</p>
        <p>Observations : {{$purchaseRequest->observation}}</p>
        <p>Motif de la demande: {{$purchaseRequest->object}}</p>
        <p>Demandeur : {{$purchaseRequest->user->name}}</p>
        </div>
    </div>
    <div class="collapse" id="ajout">
        <div class="card card-body">
            <h1 class="text-center my-5">Ajouter des Produits Pour D.A Nº {{$purchaseRequest->id}}</h1>
            
            <div class="col-md-12">
                <form method="POST" action="/demande-achat-produit">
                    @csrf
                    <input value="{{$purchaseRequest->id}}" name="purchaseRequest_id" hidden>

                    <div class="row">
                        <div class="form-group col-md-3 offset-md-3">
                            <label for="">Selectionner un produit</label>
                            <select name="product_id" class="form-control" v-model="selected" @change="onChange">
                                        <option selected disabled value="selectionner un produit">Selectionner un produit</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 ">
                            <label for="">Quantité</label>
                            <input type="text" class="form-control" name="quantity" v-model="product.quantity">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter Produit</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>



<h1 class="h1 mt-5 mb-3">Demande Achat
    @if($purchaseRequest->local_id)
        ACL00{{$purchaseRequest->local_id}}/{{($purchaseRequest->created_at)->format('Y')}}
    @else
        ACE00{{$purchaseRequest->international_id}}/{{($purchaseRequest->created_at)->format('Y')}}
    @endif
    
</h1>
<table class="table table-hover table-lg">
    <thead class="bg-success text-white">
        <tr>
            <th scope="col">Nom du Produit</th>
            <th scope="col">Quantité</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchaseRequest->products as $product)
        <tr>
            <th scope="row"><a href="/produits/{{$product->name}}">{{$product->name}}</a></th>
            <td>{{$product->pivot->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@if( ! $purchaseRequest->saved)
    <div class="form-group text-center">
        <button class="btn btn-success" @click="saveRequest({{$purchaseRequest->id}})">Enregistrer Demande <i class="fas fa-save"></i></button>
    </div>
@endif
@endsection