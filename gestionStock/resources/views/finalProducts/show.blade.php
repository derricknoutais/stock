@extends('layouts.app') 
@section('content')

<h1 class="text-center my-5">Stock {{$finalProduct->name}}</h1>

<p class="mt-5">
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Plus d'informations
        </a>
</p>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <div class="row">
            <p class="col-md-4"><strong>Quantité : </strong></p>
            <p class="col-md-4"><strong>Prix Unitaire : </strong></p>
            <p class="col-md-4"><strong>C.U.M.P : </strong></p>
        </div>

        <div class="row ">
            <p class="col-md-6 text-center"><strong class="text-danger">Montant Total : </strong></p>
            <p class="col-md-6 text-danger "><strong>Coût d'Achat : </strong></p>
        </div>
    </div>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Stock Initial</th>
                <th scope="col">Entrée</th>
                <th scope="col">Sortie</th>
                <th scope="col">Stock Final</th>
                <th scope="col">Prix de Vente</th>
            </tr>
        </thead>
    </table>
</div>

@endsection