@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Prueba Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Prueba Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'pruebaPrecios.store']) !!}

                        @include('prueba_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
