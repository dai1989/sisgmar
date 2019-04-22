@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Disminucion Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Disminucion Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'disminucionPrecios.store']) !!}

                        @include('disminucion_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
