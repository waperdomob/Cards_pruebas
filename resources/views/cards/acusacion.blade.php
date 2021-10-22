@extends('layouts.plantilla.newgame')

@section('componentes')
    

<form action="{{ route('game.store3') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="">

   
        <h5 class="pb-0 mb-0"><strong>Acusación</strong></h5>
    
    <!-- El Usuario -->
    <div class="form-group">
    
        <p>Seleccione las cartas donde podria estar el bug</p>
        
    </div>
            <div class="form-floating mb-3">
                <select class="form-select bg-light" id="programador" name="programador" aria-label="Floating label select example" wire:model="programador" >
                  <option selected>Selecciona una opción</option>
                  <option>Pedro</option>
                  <option>Juan</option>
                  <option>Carlos</option>
                  <option>Juanita</option>
                  <option>Antonio</option>
                  <option>Carolina</option>
                  <option>Manuel</option>
                </select>
                <label for="programador">Programador</label>
                
        <!-- Validación -->
        @error("programador") 
            <small class="text-danger">{{ $message }}</small> 
        @enderror
            </div>   
    
    <div class="form-floating mb-3">
        <select class="form-select" id="modulo" name="modulo" aria-label="Floating label select example" wire:model="modulo" >
          <option selected>Selecciona una opción</option>
          <option>Nomina</option>
          <option>Facturacion</option>
          <option>Comprobante contable</option>
          <option>Usuarios</option>
          <option>Contabilidad</option>
        </select>
        <label for="modulo">Módulo</label>
    
    <!-- Validación -->
    @error("modulo") 
    <small class="text-danger">{{ $message }}</small> 
    @enderror
    </div> 
    
    <div class="form-floating mb-3">
    <select class="form-select" id="error" name="error" aria-label="Floating label select example" wire:model="error" >
      <option selected>Selecciona una opción</option>
      <option>404</option>
      <option>Stack overflow</option>
      <option>Memory out of range</option>
      <option>Null pointer</option>
      <option>Syntax error</option>
      <option>Encoding error</option>
    </select>
    <label for="error">Error</label>     
    
    <!-- Validación -->
    @error("error") 
    <small class="text-danger">{{ $message }}</small> 
    @enderror
    </div>
    
    <div class="row">
        <div class="col-9">
            <!-- Mensajes de alerta -->    
            <div style="position: absolute;"
            class="alert alert-success collapse" 
            role="alert" 
            id="avisoSuccess"       
            >Se ha enviado</div>        
        </div>    
        <div class="col-3 pt-2 text-right">
            <button 
                class="btn btn-primary" 
                wire:click="enviarAcusación"
                wire:loading.attr="disabled"
                wire:offline.attr="disabled"            
            >Enviar acusación</button>
        </div>        
    </div>
</form>
@endsection