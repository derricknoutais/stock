@extends('layouts.app') 
@section('content')

    @include('partials.header') 
    
    
    @if(!$saleOrder->saved)
    <a class="btn btn-primary" data-toggle="collapse" href="#ajout" role="button" aria-expanded="false" aria-controls="collapseExample">
        Ajouter Des Produits
    </a>
    @endif
    <div class="collapse" id="ajout">
        <div class="card card-body">
            <h1 class="text-center my-5">Ajouter des Produits Pour D.A Nº {{$saleOrder->id}}</h1>

            <div class="col-md-12">
                <form method="POST" action="/bon-vente-produit">
                    @csrf
                    <input value="{{$saleOrder->id}}" name="sale_order_id" hidden>

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

    <h1 class=" mt-5">Bon de Vente Nº {{$saleOrder->id}}</h1>
    <table class="table table-hover table-lg">
        <thead class="bg-success text-white">
            <tr>
                <th scope="col">Nom du Produit</th>
                <th scope="col">Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsOrdered as $productOrdered)
            <tr>
                <th scope="row"><a href="/produit-finis/{{$productOrdered->product->name}}">{{$productOrdered->product->name}}</a></th>
                <td>{{$productOrdered->quantity}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if( ! $saleOrder->saved)
        <div class="form-group text-center">
            <button class="btn btn-success" @click="saveSaleOrder({{$saleOrder->id}})">Enregistrer Bon <i class="fas fa-save"></i></button>
        </div>
    @endif
@endsection