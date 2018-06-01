@extends('layouts.app')

@section('content')

    <h1 class="text-center my-5">Ajouter des Produits - Achat Nº {{$order->id}}</h1>
    <div class="col-md-12">
        <form method="POST" action="/bon-achat-produit">
            @csrf
            <input value="{{$order->id}}" name="order_id" hidden>

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
                <div class="form-group col-md-3">
                    <label for="">Prix Unitaire</label>
                    <input type="text" class="form-control" v-model="prixUnitaireFormat" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 offset-md-3">
                    <label for="">Quantité</label>
                    <input type="text" class="form-control" name="quantity" v-model="product.quantity">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Coût de Douane</label>
                    <input type="text" class="form-control" name="customs" v-model="product.customsCost">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 offset-md-3">
                    <label for="">Coût de Transport</label>
                    <input type="text" class="form-control" name="transport" v-model="product.transportCost">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Coût Divers</label>
                    <input type="text" class="form-control" name="otherCost" v-model="product.coutDivers">
                </div>
            </div>
            
            
            {{-- </div>
            <div class="form-group">
                <label for="">Coût de Douane</label>
                <input type="text" class="form-control" name="coutDeDouane" v-model="product.customs" disabled>
            </div>
            <div class="form-group">
                <label for="">Coût de Transport</label>
                <input type="text" class="form-control" name="coutDeTransport" v-model="product.transport" disabled>
            </div> --}}

            
            <div class="row">
                <div class="form-group offset-md-3 col-md-6">
                    <label for="">Coût Total</label>
                    <input type="text" class="form-control" name="coutTotal" v-model="coutTotal" disabled>
                </div>
            </div>
            

            

            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Ajouter <i class="fas fa-plus"></i></button>
            </div>
        </form> 
    </div>
     
    
    <h1 class="text-center my-5"></h1>
    <div class="information my-5">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Désignation</th>
                <th scope="col">Quantité</th>
                <th scope="col">Prix Unitaire</th>
                <th>Coût de Doaune</th>
                <th>Coût de Transport</th>
                <th>Coût Divers</th>
                <th scope="col">Prix Total</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <th scope="row"><a href="/produits/{{$product->name}}">{{$product->name}}</a></th>
                <td>{{$product->pivot->quantity}}</td>
                <td>@money($product->cost)</td>

                <td>@money($product->pivot->customs)</td>
                <td>@money($product->pivot->transport)</td>
                <td>@money($product->pivot->otherCost)</td>
                <td>@money($product->totalCost())</td>      
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>Total</strong></td>
                <td><strong>@money($order->total())</strong></td>
            </tr>
        </tbody>
    </table>
    <div class="form-group text-center">
      <a href="/bon-achat" class="btn btn-success" @click="confirm">Enregistrer <i class="fas fa-save"></i></a>
    </div>
   
@endsection