@extends('layouts.app') 
@section('content')
    @include('partials.header')
<div class="text-center my-5">
    <a name="" id="" class="btn btn-danger" href="/home" role="button">Retour</a>
    <a name="" id="" class="btn btn-primary" href="/bon-vente/nouveau" role="button">Créer Bon Vente <i class="fas fa-plus "></i></a>

</div>

<h1 class="my-5">Dossier Bon de Vente</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Code du Bon</th>
            <th scope="col">Client</th>
        </tr>
    </thead>
    <tbody>
        @foreach($saleOrders as $saleOrder)
        <tr>
            <th scope="row"><a href="/bon-vente/{{$saleOrder->id}}">{{$saleOrder->id}}</a></th>
            <td>{{$saleOrder->customer->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection