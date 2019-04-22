@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Contacto Proveedor
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Contacto Proveedor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($contactoProveedor, ['route' => ['contactoProveedors.update', $contactoProveedor->id], 'method' => 'patch']) !!}

                        @include('contacto_proveedors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection