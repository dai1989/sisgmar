@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Prueba Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Prueba Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pruebaPrecio, ['route' => ['pruebaPrecios.update', $pruebaPrecio->id], 'method' => 'patch']) !!}

                        @include('prueba_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection