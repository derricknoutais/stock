
@extends('layouts.app')

@section('content')

    @include('partials.header')
    <h1 class="text-center my-5">Créer Bon Comnmande pour D.A 
        @if($request->local_id)
            ACL00{{$request->local_id}}/{{($request->created_at)->format('Y')}}
        @else
            ACE00{{$request->international_id}}/{{($request->created_at)->format('Y')}}
        @endif
    </h1>
    <div class="col-md-12 text-center">
        <form method="POST" action="/bon-commande/nouveau">
            @csrf
            <table class="table ">
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
                    <input type="text" name="request" value={{$request->id}} hidden>
                    @foreach($request->products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td><input class="form-control" name="unit_price{{$loop->index}}"></td>
                        <td><input class="form-control" name="" disabled></td>
                        <td><input class="form-control" name="imputation{{$loop->index}}"></td>
                        <td><input class="form-control" name="observation{{$loop->index}}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    

@endsection