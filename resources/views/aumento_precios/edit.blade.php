@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Aumento Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Aumento Precio
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aumentoPrecio, ['route' => ['aumentoPrecios.update', $aumentoPrecio->id], 'method' => 'patch']) !!}

                        @include('aumento_precios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection