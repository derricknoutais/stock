@extends('layouts.app')

@section('content')
<br>
<br>
    <h2 class="text-center" >Voulez vous vraiment retourner le véhicule?</h2>
    <form id="retour-form" action="{{ route('contrats.update' , [$contrat->id]) }}" method="POST" class="text-center" >
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <input type="date" name="date_retour_reelle" value="{{ Carbon::now()->format('Y-m-d')  }}" style="display: none">
            <input type="text" name="client_id" value="{{ $contrat->client_id }}" style="display: none">
            <input type="date" name="date_retour_prevue" value="{{ ($contrat->date_retour_prevue)->format('Y-m-d') }}" style="display: none">
            <input type="" name="caution" value="{{ $contrat->caution }}" style="display: none">
            <input type="submit" class="btn btn-primary" value="Oui">
            <a href="{{ route('contrats.index') }}" class="btn btn-primary" title="">Non</a>
    </form>

@endsection
