@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3 text-center">
    <h3>Nouveau Client</h3>
    <form action="{{ route('clients.store') }}" method="post" class="text-center" >
                    {{ csrf_field() }}
                    <div class="form-group col-md-6" >
                        <label for="nom">Nom<span class="required">*</span></label>
                        <input id="nom" type="text" name="nom" class="form-control" spellcheck="false" required placeholder="Moubamba, Benzema, Talon" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="prenom">Prenom<span class="required">*</span></label>
                        <input id="prenom" type="text" name="prenom" class="form-control" spellcheck="false" required placeholder="Bruno, Karim, Patrice" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="addresse">Addresse<span class="required">*</span></label>
                        <input id="addresse" type="text" name="addresse" class="form-control" spellcheck="false" required placeholder="Ngady, Case d'écoute, Salsa" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="ville">Ville<span class="required">*</span></label>
                        <select id="ville" type="text" name="ville" class="form-control" spellcheck="false" required placeholder="30000, 50000" >
                            <option value="Port-Gentil" selected>Port-Gentil</option>
                            <option value="Port-Gentil">Libreville</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12" >
                        <label for="numero_permis">Numéro de Permis<span class="required">*</span></label>
                        <input id="numero_permis" type="text" name="numero_permis" class="form-control" spellcheck="false" required placeholder="BO212321123" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="numero_phone">Numéro de Téléphone<span class="required">*</span></label>
                        <input id="numero_phone" type="text" name="numero_phone" class="form-control" spellcheck="false" required placeholder="07158215" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="numero_phone2">Deuxieme Numéro de Téléphone<span class="required">*</span></label>
                        <input id="numero_phone2" type="text" name="numero_phone2" class="form-control" spellcheck="false" required placeholder="06268275" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="email">E-Mail<span class="required">*</span></label>
                        <input id="email" type="text" name="email" class="form-control" spellcheck="false" required placeholder="servicestousazimuts@gmail.com" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_naissance">Date de Naissance<span class="required">*</span></label>
                        <input id="date_naissance" type="date" name="date_naissance" class="form-control" spellcheck="false" required />
                    </div>
                    <div class="form-group" >
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>

    </form>
</div>
@endsection
