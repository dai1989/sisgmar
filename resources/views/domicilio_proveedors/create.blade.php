@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Domicilio Proveedor
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Domicilio Proveedor
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'domicilioProveedors.store']) !!}

                        @include('domicilio_proveedors.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
