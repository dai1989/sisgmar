@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Tipo Domicilios
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tipo Domicilios</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tipoDomicilios.create') !!}">
              <i class="fa fa-plus"></i>
              <span class="hidden-xs hidden-sm">Agregar</span>
           </a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('tipo_domicilios.table')
            </div>
        </div>
    </div>
@endsection

