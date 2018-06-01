@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3 text-center">
    <h3>Modifier Contrat</h3>
    <form action="{{ route('contrats.update', [$contrat->id]) }}" method="post" class="text-center" >
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    @if($voitures != null )
                    <div class="form-group col-md-6" >
                        <label for="voiture_id">Choisissez la voiture<span class="required">*</span></label>
                        <select id="voiture_id" type="text" name="voiture_id" class="form-control" spellcheck="false" required disabled placeholder="30000, 50000" >
                            @forelse($voitures as $voiture)
                            <option @if ($voiture->id == $contrat->voiture_id)
                                selected
                            @endif value="{{ $voiture->id }}"> {{ $voiture->immatriculation }} </option>
                            @empty
                            <option selected disabled value=""> Aucune voiture dispo</option>
                            @endforelse
                        </select>
                    </div>
                    @else
                    <input name="voiture_id" type="hidden" value="{{ $voiture_id }}" class="form-control" />
                    @endif

                    @if($clients !=null )
                    <div class="form-group col-md-6" >
                        <label for="client_id">Choisissez le client<span class="required">*</span></label>
                        <select id="client_id" type="text" name="client_id" class="form-control" spellcheck="false" required placeholder="30000, 50000" >
                            @foreach($clients as $client)
                            <option  @if ($client->id == $contrat->client_id)
                                selected
                            @endif value="{{ $client->id }}"> {{ $client->nom . " " . $client->prenom }} </option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input name="client_id" type="hidden" value="{{ $client_id }}" class="form-control" />
                    @endif
                    <div class="form-group col-md-6" >
                        <label for="date_retour_prevue">Date de Retour<span class="required">*</span></label>
                        <input id="date_retour_prevue" type="date" name="date_retour_prevue" class="form-control" spellcheck="false" required value="{{ ($contrat->date_retour_prevue)->format('Y-m-d') }}" />
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="caution">Caution<span class="required">*</span></label>
                        <input id="caution" type="number" name="caution" class="form-control" spellcheck="false" required value="{{ $contrat->caution }}" />
                    </div>

                    <div class="form-group" >
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>

    </form>
</div>
@endsection
