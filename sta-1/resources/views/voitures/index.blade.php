@extends('layouts.app')
@section('content')
@foreach($voitures as $voiture)
<div class="col-sm-6 col-md-4 col-lg-3 mt-4">
    <div class="card card-inverse card-primary">
        <a href="voitures/{{ $voiture->id }}">
            <img class="card-img-top" src="https://imgct2.aeplcdn.com/img/800x600/car-data/big/maruti-suzuki-swift-default-image.png-version201710292106.png">
        </a>
        <div class="card-block">
            <h4 class="card-title mt-3">{{ $voiture->immatriculation }}</h4>
            <div class="meta card-text">
                <p>{{ $voiture->marque  . " " . $voiture->type }}</p>
            </div>
            <div class="card-text">
                <p>Prix: {{ number_format($voiture->prix, 0) }} F CFA</p>
            </div>
        </div>
        <div class="card-footer text-center">
             <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#product_view"><i class="fa fa-info-circle"></i> Détails</a>

            <a class="btn btn-primary float-right btn-xs" href="/voitures/{{ $voiture->id }}/edit"><i class="fa fa-pencil-square-o"></i> Modifier</a>

            <a href="#" type="button" class="btn btn-primary btn-xs" onclick="var result = confirm('Etes vous sur de vouloir supprimer un client?');
                if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                }"><i class="fa fa-trash-o"></i> Supprimer</a>
                <form id="delete-form" action="{{ route('voitures.destroy' , [$voiture->id]) }}" method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                </form>
        </div>
    </div>
</div>
<div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">{{ $voiture->marque . " " . $voiture->type }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="https://imgct2.aeplcdn.com/img/800x600/car-data/big/maruti-suzuki-swift-default-image.png-version201710292106.png" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>{{ $voiture->immatriculation }}</h4>
                        <p> {{ $voiture->etat_voiture }}</p>
                        <h3 class="cost">{{ number_format($voiture->prix, 0) }} F CFA</h3>
                        <div class="space-ten"></div>
                        <div class="btn-ground">
                            <a type="button" class="btn btn-primary" href="contrats/create/{{ $voiture->id }}"><i class="fa fa-car"></i> Faire Louer </a>
                            <a type="button" href="voitures/{{ $voiture->id }}" class="btn btn-primary" ><i class="fa fa-eye"></i> Voir Plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
