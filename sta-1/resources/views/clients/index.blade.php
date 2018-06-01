@extends('layouts.app')

@section('content')
@foreach($clients as $client)
<div class="col-sm-6 col-md-4 col-lg-3 mt-4">
    <div class="card card-inverse card-info">
        <img class="card-img-top img-responsive" src="https://avatars1.githubusercontent.com/u/11767240?v=3&s=400">
        <div class="card-block">
            <h4 class="card-title mt-3 text-center">{{ $client->nom . " " . $client->prenom }}</h4>
            <div class="meta card-text">
                <p><p>Phone: {{ $client->numero_phone  }} @if($client->numero_phone2 != "") / {{ $client->numero_phone2  }} @endif  </p></p>
                <p>Addresse: {{ $client->addresse }}</p>
                <p>Ville: {{ $client->ville }}</p>
            </div>
        </div>
        <div class="card-footer text-center">
             <a type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#product_view{{ $client->id }}"><i class="fa fa-info-circle"></i> Détails</a>

            <a class="btn btn-primary float-right btn-xs" href="/clients/{{ $client->id }}/edit"><i class="fa fa-pencil-square-o"></i> Modifier</a>

            <a href="#" type="button" class="btn btn-primary btn-xs" onclick="var result = confirm('Etes vous sur de vouloir supprimer {{ $client->nom . " " . $client->prenom }} ?');
                if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                }"><i class="fa fa-trash-o"></i> Supprimer</a>
                <form id="delete-form" action="{{ route('clients.destroy' , [$client->id]) }}" method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                </form>
        </div>
    </div>
</div>
<div class="modal fade product_view" id="product_view{{ $client->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">{{ $client->nom . " " . $client->prenom }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="https://avatars1.githubusercontent.com/u/11767240?v=3&s=400" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <p><strong>Age:</strong> {{ Carbon\Carbon::parse($client->date_naissance)->diffInYears(Carbon\Carbon::now()) }} ans</p>
                        <p><strong>Addresse:</strong> {{ $client->addresse }}</p>
                        <p><strong>Ville:</strong> {{ $client->ville }}</p>
                        <p><strong>Nº Permis:</strong> {{ $client->numero_permis }}</p>
                        <p><strong>Nº Téléphone:</strong> {{ $client->numero_phone }} @if($client->numero_phone != "") / {{ $client->numero_phone2  }} @endif </p>
                        <p><strong>e-mail:</strong> {{ $client->email }}</p>
                        <div class="space-ten"></div>
                        <div class="btn-ground">
                            <a type="button" class="btn btn-primary" href="contrats/{{ $client->id }}/create"><i class="fa fa-car"></i> Faire Louer </a>
                            <a type="button" href="clients/{{ $client->id }}" class="btn btn-primary"><i class="fa fa-eye"></i> Voir Plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
