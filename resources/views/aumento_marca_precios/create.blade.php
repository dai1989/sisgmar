@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Aumento Marca Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Aumento Marca Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'aumentoMarcaPrecios.store']) !!}

                        @include('aumento_marca_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
