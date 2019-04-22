@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Disminucion Categoria Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Disminucion Categoria Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($disminucionCategoriaPrecio, ['route' => ['disminucionCategoriaPrecios.update', $disminucionCategoriaPrecio->id], 'method' => 'patch']) !!}

                        @include('disminucion_categoria_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection