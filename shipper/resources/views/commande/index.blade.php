@extends('layouts.welcome')


@section('content')

    <section class="tw-flex tw-flex-col tw-items-center tw-bg-gray-800 tw-text-white">
        <p class="tw-text-4xl tw-text-bold tw-my-4">Mes Commandes</p>
        <p class="tw-mb-4">
            Les commandes vous permettent d'enregistrer un groupe de produits que vous pouvez réutiliser dans vos commandes
        </p>
        <button class="tw-btn tw-btn-white tw-mb-4" data-toggle="modal" data-target="#modelId">Créer commande</button>
        <!-- Modal -->
    </section>
    <section class="container mx-auto mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th># Produits</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td scope="row">
                            <a href="/commande/{{ $commande->id }}">{{ $commande->name }}</a>
                            
                        </td>
                        {{-- <td>{{ sizeof($commande) }}</td> --}}
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </section>




    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enregistrer Commande en tant que...</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/commande" method="POST">
                <div class="modal-body">
                    
                        @csrf
                        <div class="form-group">
                          <label for="">Nom </label>
                          <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection