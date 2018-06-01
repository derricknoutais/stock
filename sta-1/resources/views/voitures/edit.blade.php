@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3">
    <form action="{{ route('voitures.update' , [$voiture->id]) }}" method="post" >
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group col-md-6" >
                        <label for="marque">Marque<span class="required">*</span></label>
                        <input id="marque" type="text" name="marque" class="form-control" spellcheck="false" value="{{  $voiture->marque }}" required placeholder="Toyota, Mitsubushi, Mazda" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="type">Type<span class="required">*</span></label>
                        <input id="type" type="text" name="type" class="form-control" spellcheck="false" required placeholder="Corolla, Rav4, Pajero" value="{{  $voiture->type }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="immatriculation">Immatriculation<span class="required">*</span></label>
                        <input id="immatriculation" type="text" name="immatriculation" class="form-control" spellcheck="false" required placeholder="EZ-442-AA"  value="{{  $voiture->immatriculation }}"/>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="prix">Prix<span class="required">*</span></label>
                        <input id="prix" type="text" name="prix" class="form-control" spellcheck="false" required placeholder="30000, 50000" value="{{  $voiture->prix }}"/>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_expiration_assurance">Assurance Expire Le<span class="required">*</span></label>
                        <input id="date_expiration_assurance" type="date" name="date_expiration_assurance" class="form-control" spellcheck="false" required placeholder="" value="{{  $voiture->date_expiration_assurance }}"/>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_expiration_carte_grise">Carte Grise Expire Le<span class="required">*</span></label>
                        <input id="date_expiration_carte_grise" type="date" name="date_expiration_carte_grise" class="form-control" spellcheck="false" required placeholder="" value="{{  $voiture->date_expiration_carte_grise }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_expiration_visite_technique">Visite Technique Expire Le<span class="required">*</span></label>
                        <input id="date_expiration_visite_technique" type="date" name="date_expiration_visite_technique" class="form-control" spellcheck="false" required placeholder="" value="{{  $voiture->date_expiration_visite_technique }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="date_expiration_carte_extincteur">Carte Extincteur Expire Le<span class="required">*</span></label>
                        <input id="date_expiration_carte_extincteur" type="date" name="date_expiration_carte_extincteur" class="form-control" spellcheck="false" required value="{{  $voiture->date_expiration_carte_extincteur }}"/>
                    </div>
                    <div class="form-group col-md-12" >
                        <label for="etat_voiture">État de la voiture<span class="required">*</span></label>
                        <textarea id="etat_voiture" rows="5" name="etat_voiture"  class="form-control" spellcheck="false" required>
                        {{  $voiture->etat_voiture }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <div class="row form-group">
                            <label class="checkbox-inline"><input type="checkbox" name="pneu_secours" @if($voiture->pneu_secours) checked @endif
                                />Pneu Secours</label>
                            <label class="checkbox-inline"><input type="checkbox" name="crick" @if($voiture->crick) checked @endif
                                />Crick</label>
                            <label class="checkbox-inline"><input type="checkbox" name="boite_pharmacie" @if($voiture->boite_pharmacie) checked @endif
                                />Boite Pharmacie</label>
                            <label class="checkbox-inline"><input type="checkbox" name="triangle" @if($voiture->triangle) checked @endif
                                />Triangle</label>
                        </div>
                        <div class="row form-group">
                            <label class="checkbox-inline"><input type="checkbox" name="calle_metallique" @if($voiture->calle_metallique) checked @endif
                                />Calle Métallique</label>
                            <label class="checkbox-inline"><input type="checkbox" name="cle_roue" @if($voiture->cle_roue) checked @endif
                                />Clé à Roue</label>
                            <label class="checkbox-inline"><input type="checkbox" name="gilet" @if($voiture->gilet) checked @endif
                                />Gilet</label>
                            <label class="checkbox-inline"><input type="checkbox" name="baladeuse" @if($voiture->baladeuse) checked @endif
                                />Baladeuse</label>
                        </div>

                    </div>
                    <div class="form-group" >
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>

    </form>
</div>
@endsection
