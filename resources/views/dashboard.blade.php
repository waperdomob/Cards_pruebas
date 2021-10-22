    
@extends('layouts.plantilla.newgame')

@section('title', 'Home!!')
    @section('componentes')
        
        <div class="container">
            <a href="{{ route('game.create')}}" class="btn btn-primary">Cree una nueva partida</a><br>
            <a href="{{ route('game.index')}}" class="btn btn-warning">Ingrese a una partida</a>
        </div> 
                        
    @endsection

