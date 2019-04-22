@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Domicilio Proveedor
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Domicilio Proveedor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($domicilioProveedor, ['route' => ['domicilioProveedors.update', $domicilioProveedor->id], 'method' => 'patch']) !!}

                        @include('domicilio_proveedors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection