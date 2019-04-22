@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Aumento Producto Precio
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Aumento Producto Precio
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'aumentoProductoPrecios.store']) !!}

                        @include('aumento_producto_precios.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
