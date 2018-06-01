@extends('layouts.app') 
@section('content')

@include('partials.header')

{{-- <table class="table">
    <thead>
        <tr>
            <th scope="col">Nº</th>
            <th scope="col">Libellé</th>
            <th>État</th>
            <th scope="col">Émis Par</th>
            <th scope="col">Date De Création</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $request)
        <tr>
            <td><a href="/demande-achat/{{$request->id}}">
                @if($request->local_id)
                    ACL00{{$request->local_id}}/{{($request->created_at)->format('Y')}}
                @else
                    ACE00{{$request->international_id}}/{{($request->created_at)->format('Y')}}
                @endif
            </a></td>
            <td>{{$request->description}}</td>
            <td>@state($request->state)</td>
            <td>{{$request->user->name}}</td>
            <td>{{($request->created_at)->format('d-M-y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table> --}}



{{-- <p class="text-center">{{$links}}</p> --}}

<purchase-requests></purchase-requests>

@endsection