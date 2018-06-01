@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3 text-center">
    <h3>Nouveau Payement</h3>
    <form action="{{ route('payements.store') }}" method="post" class="text-center" >
                    {{ csrf_field() }}
                    @if(count($contrats) >= 1 )
                    <div class="form-group col-md-6" >
                        <label for="contrat_id">Choisissez le contrat<span class="required">*</span></label>
                        <select id="contrat_id" type="text" name="contrat_id" class="form-control" spellcheck="false" required placeholder="30000, 50000" >
                            @forelse($contrats as $contrat)
                            <option selected value="{{ $contrat->id }}"> Facture Nº 00{{ $contrat->id }} </option>
                            @empty
                            <option selected disabled value=""> Aucun contrat</option>
                            @endforelse
                        </select>
                    </div>
                    @else
                    <input name="contrat_id" type="hidden" value="{{ $contrat_id }}" class="form-control" />
                    @endif
                    <div class="form-group col-md-6" >
                        <label for="versement">Somme<span class="required">*</span></label>
                        <input id="versement" type="number" name="versement" class="form-control" spellcheck="false" required value="100000" />
                    </div>

                    <div class="form-group" >
                        <input type="submit" class="btn btn-primary" value="Submit" />
                    </div>

    </form>
</div>
@endsection
