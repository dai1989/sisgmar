@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Disminucion Marca Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Disminucion Marca Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'disminucionMarcaPrecios.store']) !!}

                        @include('disminucion_marca_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
