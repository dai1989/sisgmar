@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Disminucion Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Disminucion Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($disminucionPrecio, ['route' => ['disminucionPrecios.update', $disminucionPrecio->id], 'method' => 'patch']) !!}

                        @include('disminucion_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection