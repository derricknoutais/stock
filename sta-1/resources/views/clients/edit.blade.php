@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3 text-center">
    <h3>Modifier Client</h3>
    <form action="{{ route('clients.update', [$client->id]) }}" method="post" class="text-center" >
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group col-md-6" >
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input id="nom" type="text" name="nom" class="form-control" spellcheck="false" required value="{{ $client->nom  }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="prenom">Prenom<span class="required">*</span></label>
                        <input id="prenom" type="text" name="prenom" class="form-control" spellcheck="false" required value=" {{ $client->prenom }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="addresse">Addresse<span class="required">*</span></label>
                        <input id="addresse" type="text" name="addresse" class="form-control" spellcheck="false" required value="{{ $client->addresse }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="ville">Ville<span class="required">*</span></label>
                        <select id="ville" type="text" name="ville" class="form-control" spellcheck="false" value="{{ $client->ville }}" >
                            <option value="Port-Gentil">Port-Gentil</option>
                            <option value="Libreville">Libreville</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12" >
                        <label for="numero_permis">Numéro de Permis<span class="required">*</span></label>
                        <input id="numero_permis" type="text" name="numero_permis" class="form-control" spellcheck="false" required value="{{ $client->numero_permis }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="numero_phone">Numéro de Téléphone<span class="required">*</span></label>
                        <input id="numero_phone" type="text" name="numero_phone" class="form-control" spellcheck="false" required value="{{ $client->numero_phone }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="numero_phone2">Deuxieme Numéro de Téléphone<span class="required">*</span></label>
                        <input id="numero_phone2" type="text" name="numero_phone2" class="form-control" spellcheck="false" required value="{{ $client->numero_phone2  }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="email">E-Mail<span class="required">*</span></label>
                        <input id="email" type="text" name="email" class="form-control" spellcheck="false" required value="{{ $client->email }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_naissance">Date de Naissance<span class="required">*</span></label>
                        <input id="date_naissance" type="date" name="date_naissance" class="form-control" spellcheck="false" required value="{{ $client->date_naissance }}" />
                    </div>
                    <div class="form-group" >
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>

    </form>
</div>
@endsection
