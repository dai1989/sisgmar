@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Role
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Role
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                    @include('roles.show_fields')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('roles.index') !!}" class="btn btn-info">Regresar</a>
            </div>
        </div>
    </div>
@endsection
