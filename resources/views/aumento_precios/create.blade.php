@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Aumento Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Aumento de Precio por Categoria
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'aumentoPrecios.store']) !!}

                        @include('aumento_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
