@extends('layouts.app')

@section('content')

    <h1 class="text-center my-5">
        @if($type)
            @print($type)
        @else
            Produits de Base
        @endif
    </h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom Produit</th>
                <th scope="col">Qté (kg)</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td scope="row"><a href="/produits/{{$product->name}}">{{$product->name}}</a></td>
                    <td>{{number_format($product->quantity, 0, ',', '.')}}</td>
                    <td>@money($product->cost)</td>
                    <td class="font-weight-bold">@money($product->value())</td>
                </tr>
            @endforeach
            @php
                $total = 0;
                foreach ($products as $product) {
                    $total += $product->value();
                }
            @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold text-success">Valeur Totale</td>
                    <td class="font-weight-bold text-success">@money($total)</td>
                </tr>
        </tbody>
    </table>
@endsection