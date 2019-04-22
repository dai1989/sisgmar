@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Aumento Marca Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Aumento Marca Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aumentoMarcaPrecio, ['route' => ['aumentoMarcaPrecios.update', $aumentoMarcaPrecio->id], 'method' => 'patch']) !!}

                        @include('aumento_marca_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection