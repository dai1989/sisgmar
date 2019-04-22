@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Estadistica Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Estadistica Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'estadisticaPrecios.store']) !!}

                        @include('estadistica_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
