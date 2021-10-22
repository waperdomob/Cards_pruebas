@extends('layouts.plantilla.newgame')
@section('componentes')
    @if (Session::has('mensaje'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{  Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


<div class="container flex-center mt-4">
  <div class="row">

  <div class="col ">
    <div>
        <a class="btn btn-primary mt-4 " href="{{ route('home') }}">Regresar</a>
    </div>

    </div>
    <div class="col">
     </div>
   
    <div class="col-4 mt-4">
    <form action="{{ route('game.store')}}" method="post">
        @csrf 
        <div class="form-group">
          <label for="id">Ingrese el codigo para un nuevo juego</label>
          <input type="text" name="id" id="id" class="form-control mt-4" placeholder="H53DY" aria-describedby="helpId" required>
        </div>
        <div class="form-group">
            <input type="number" name="count" id="count" class="form-control" placeholder="H53DY" aria-describedby="helpId" hidden value="1">
        </div>
        <div class="form-group">
            <input type="number" name="winner" id="winner" class="form-control" placeholder="H53DY" aria-describedby="helpId" hidden value="0">
        </div>

        <button type="submit" class="btn btn-warning mt-4">Enviar</button>
        
    </form>


    </div>
    
    <div class="col">
    

    </div>
    <div class="col">

   </div>
  
  </div>
</div>
@endsection