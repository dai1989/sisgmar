@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Estadistica Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Estadistica Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($estadisticaPrecio, ['route' => ['estadisticaPrecios.update', $estadisticaPrecio->id], 'method' => 'patch']) !!}

                        @include('estadistica_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection