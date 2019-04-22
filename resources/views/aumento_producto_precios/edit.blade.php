@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Aumento Producto Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Aumento Producto Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aumentoProductoPrecio, ['route' => ['aumentoProductoPrecios.update', $aumentoProductoPrecio->id], 'method' => 'patch']) !!}

                        @include('aumento_producto_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection