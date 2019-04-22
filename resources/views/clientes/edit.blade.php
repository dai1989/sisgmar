@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Cliente
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Cliente
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!!Form::model($persona,['route'=>['clientes.update', $persona->id] , 'method'=>'PATCH'])!!}
                   {{Form::token()}}

                       <!-- Descripcion Field -->
<div class="form-group col-sm-6">
     <label for="nombre">Nombre</label>
     <input type="text" class="form-control" id="nombre" name="nombre" 
     value="{{$persona->nombre}}"  placeholder="nombre completo">
</div>
<div class="form-group col-sm-6">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido"
     value="{{$persona->apellido}}"  placeholder="apellido">
</div>
<div class="form-group col-sm-6">
   <label for="documento">Documento</label>
   <input type="text" class="form-control" id="documento" name="documento" 
   value="{{$persona->documento}}" placeholder="documento">
</div>
<div class="form-group col-sm-6">
    <label for="fecha_nacimiento">Fecha de Nacimento</label>
    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{$persona->fecha_nacimiento}}"  placeholder="fecha de nacimiento">
</div>
<div class="form-group col-sm-6">
   <label for="genero">Genero</label>
 <input class="form-control" name="genero" id="genero" 
 value="{{$persona->genero}}" class="form-control">
</div>
<div class="form-group col-sm-6">
   <label for="tipo_documento">Tipo de Documento</label>
 <input class="form-control" name="tipo_documento" id="tipo_documento" 
 value="{{$persona->tipo_documento}}" class="form-control">
</div>
<div class="form-group col-sm-6">
   <label for="tipo_persona">Tipo de Cliente</label>
 <input class="form-control" name="tipo_persona" id="tipo_persona" 
 value="{{$persona->tipo_persona}}" class="form-control">
</div>
<div class="form-group col-sm-6">
   <label for="condicion_iva">Condicion frente al IVA</label>
 <input class="form-control" name="condicion_iva" id="condicion_iva" 
 value="{{$persona->condicion_iva}}" class="form-control">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('clientes.index') !!}" class="btn btn-danger">Cancelar</a>
</div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection