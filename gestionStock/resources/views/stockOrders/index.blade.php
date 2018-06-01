
@extends('layouts.app')

@section('content')
    @include('partials.header')
    <div class="text-center my-5">
        <a name="" id="" class="btn btn-danger" href="/home" role="button">Retour</a>
    </div>

    <h1 class="my-5">Dossier Bon de Commandes</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Code du Bon</th>
                <th scope="col">Libellé</th>
                <th scope="col">Cout Total du Bon</th>
                <th scope="col">Date Création</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row"><a href="/bon-commande/{{$order->id}}">
                        @if($order->id < 10)
                            00{{$order->id}}
                        @elseif($order->id < 100)
                            0{{$order->id}}
                        @else
                            {{$order->id}}
                        @endif
                        
                    </a></th>
                    <td>{{$order->description}}</td>
                    <td>@money($order->montantTotal())</td>
                    <td>{{$order->created_at->format('d-M-Y')}}</td>
                    <td>
                        @if($order->daf_signed && $order->dg_signed)
                            Approuvé (2/2)
                        @elseif($order->daf_signed || $order->dg_signed)
                            En Cours d'Approbation (1/2)
                        @else 
                            En Attente d'Approbation (0/2)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection