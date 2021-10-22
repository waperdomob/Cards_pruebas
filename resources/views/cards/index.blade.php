@extends('layouts.plantilla.newgame')

@section('componentes')

<!-- sidebar fijo  -->

<div class="row">
  
  <div class="col-sm-2">
            <table class="table">
        <thead>
            <tr>
            <th scope="col">JUGADORES</th>      
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
            <tr>               
            <td class="w-34"><img src="img/user.png" width="35px" hright="30px"  alt="">           
                {{$player -> name}}            
            </td>             
            </tr>
            @endforeach

        </tbody>
        </table>
            @if ($turno == 1 )
                @include('cards.option')
            @endif
    </div>
   
    <div class="col-sm-7">

        <div class="row mt-2 ml-4">
            @foreach ($cards as $card)                
                    
                        <div class="card ml-4" style="width: 10rem;">
                            @if ($card->image)
                            <img src="{{ asset('storage'.'/'.$card->image)}}" class="card-img-top" alt="..."  height="150">
                        @endif
                            <div class="card-body">
                                <p class="card-text">{{ $card->name }}</p>
                            </div>
                        </div>
            @endforeach
        </div>  
    </div>

    <div class="col-sm-3">
            <table class="table">
        <thead>
            <tr>
            <th scope="col">CARTA</th>
            <th scope="col">CHECK</th>
            <th scope="col">CARTA</th>
            <th scope="col">CHECK</th>
            
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pedro</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>

                 <td>Juan</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
           
            <tr>
                <td>Carlos</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
           
            
            
                <td>Juanita</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Antonia</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            
            
                <td>Carolina</td>
                    <td>
                        <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Manuel</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Nomina</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            
            
                <td>Facturacion</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Recibos</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            
            
                <td>Comprobante contable</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Usuarios</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            
            
                <td>Contabilidad</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>404</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
           
                <td>stack overflow</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>memory out of range</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
           
            
                <td>Null pointer</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>
            <tr>
            
                <td>Syntax Error</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            
                <td>Encoding Error</td>
                    <td>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
            </tr>

        </tbody>
        </table>
    </div>
  </div>
@include('modals.modal_acusacion')
@endsection

