@extends('layouts.app') 
@section('content')

<h1 class="text-center my-5">Effectuer Demande Achat</h1>
<div class="col-md-6 offset-md-3">
    <form method="POST" action="/demande-achat">
        @csrf
        <div class="form-group">
            <label for="">Type de la demande</label>
            <select name="type" id="" class="form-control">
                <option value=0>Local</option>
                <option value=1>International</option>
              </select>
        </div>

        <div class="form-group">
            <label for="">Selectionner un fournisseur</label>
            <select name="supplier" id="" class="form-control">
                    @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
              </select>
            </div>
        <div class="form-group">
            <label for="">Observations</label>
            <textarea name="observation" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">Motif de la demande</label>
            <textarea name="object" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Enregistrer <i class="fas fa-save"></i></button>
        </div>
    </form>
</div>
@endsection