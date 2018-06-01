@extends('layouts.app')

@section('content')

    <h1 class="text-center my-5">Stock {{$product->name}}</h1>

    <p class="mt-5">
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Plus d'informations
        </a>
    </p>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="row">
                <p class="col-md-4"><strong>Quantité : </strong> {{number_format($product->currentStock())}} kg</p>
                <p class="col-md-4"><strong>Prix Unitaire : </strong> @money($product->cost)</p>
                <p class="col-md-4"><strong>C.U.M.P : </strong> @money($product->cump)</p>
            </div>

            <div class="row ">
                <p class="col-md-6 text-center"><strong class="text-danger">Montant Total : </strong> @money($product->totalValue())</p>
                <p class="col-md-6 text-danger "><strong>Coût d'Achat : </strong></p>
            </div>
            
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Stock Initial</th>
                <th scope="col">Entrée</th>
                <th scope="col">Sortie</th>
                <th scope="col">Stock Final</th>
                <th scope="col">Coût Unitaire</th>
                <th scope="col">C.U.M.P</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{$product->stock_initial}}</th>
                <td></td>
                <td></td>
                <td>{{$final = $product->stock_initial}}</td>
                <td>@money($product->cost)</td>
                <td>@money($cump_init = $product->cost)</td>
            </tr>
            @foreach($stocks as $stock)
                <tr>
                    <th scope="row">{{$final}}</th>
                    <td>{{$stock->stock_in}}</td>
                    <td>{{$stock->stock_out}}</td>
                    <td>{{$final += $stock->stock_in }}</td>
                    @php
                        
                        if($loop->first){
                            $cump1 = ($cump_init * $product->stock_initial + $stock->unit_cost * $stock->stock_in) / $final;
                        } else {
                            $cump1 = ($cump1 * $old_final + $stock->unit_cost * $stock->stock_in)/$final;
                        }
                        $old_final = $final;
                    @endphp
                    <td>@money($stock->unit_cost)</td>
                    <td>@money($cump1)</td>
                </tr>
                {{-- @php
                    $final +=  $stock->stock_in - $stock->stock_out;
                @endphp --}}
            @endforeach
        </tbody>
    </table>

@endsection
