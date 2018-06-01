@extends('layouts.app')

@section('content')

<h1 class="text-center my-5">Créer Bon Vente</h1>
<div class="col-md-6 offset-md-3">
    <form method="POST" action="/bon-vente">
        @csrf

        <div class="form-group">
            <label for="">Selectionner un client</label>
            <select name="customer" id="" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
              </select>
        </div>
        <div class="form-group">
            <label for="">Observations</label>
            <textarea name="observation" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">Enregistrer <i class="fas fa-save"></i></button>
        </div>
    </form>
</div>

@endsection