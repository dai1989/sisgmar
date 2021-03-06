@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Disminucion Marca Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Disminucion Marca Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($disminucionMarcaPrecio, ['route' => ['disminucionMarcaPrecios.update', $disminucionMarcaPrecio->id], 'method' => 'patch']) !!}

                        @include('disminucion_marca_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection