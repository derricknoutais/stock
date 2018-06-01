@extends('layouts.app')

@section('content')

    <h1 class="text-center my-5">Produit Finis</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Désignation</th>
                <th scope="col">Conditionement</th>
                <th scope="col">Poids Emballage</th>
                <th scope="col">Qté (kg)</th>
                <th scope="col">Prix Unitaire</th>
                <th scope="col">Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalProducts as $finalProduct)
                <tr>
                    <td scope="row"><a href="/produits/{{$finalProduct->name}}">{{$finalProduct->name}}</a></td>
                    <td>{{$finalProduct->conditioning}}</td>
                    <td>{{$finalProduct->conditioning_weight}}</td>
                    <td>{{number_format($finalProduct->quantity, 0, ',', '.')}}</td>
                    <td>@money($finalProduct->cost)</td>
                    <td class="font-weight-bold">@money($finalProduct->value())</td>
                </tr>
            @endforeach
            @php
                $total = 0;
                foreach ($finalProducts as $finalProduct) {
                    $total += $finalProduct->value();
                }
            @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="font-weight-bold text-success">Valeur Totale</td>
                    <td class="font-weight-bold text-success">@money($total)</td>
                </tr>
        </tbody>
    </table>
@endsection