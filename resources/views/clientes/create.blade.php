@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear Cliente
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Cliente
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                   {!! Form::open(array('url' => 'clientes', 'method'=>'POST', 'autocomplete' => 'off'))!!}
                    {{Form::token()}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('nombre', 'Nombre Completo:') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('apellido', 'Apellido:') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('documento', 'Documento:') !!}
                        {!! Form::text('documento', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento:') !!}
                        {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="genero">Genero</label>
                        <select class="form-control" name="genero" id="genero" class="form-control">
                            <option value="">--Seleccionar--</option><br>
                            <option value="Masculino">M</option>
                            <option value="Femenino">F</option>
                            <option value="Otro">Otro</option>
                        </select><br>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tipo_documento">Tipo de documento</label>
                        <select class="form-control" name="tipo_documento" id="tipo_documento" class="form-control">
                            <option value="">--Seleccionar--</option><br>
                            <option value="DNI">DNI</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="C.I PY">CI PY</option>
                        </select><br>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tipo_persona">Tipo de Cliente</label>
                        <select class="form-control" name="tipo_persona" id="tipo_persona" class="form-control">
                            <option value="">--Seleccionar--</option><br>
                            <option value="Cliente">Cliente</option>
                            <option value="Cliente Cuenta Corriente">Cliente Cta Cte</option>
                        </select><br>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="condicion_iva">Condicion frente al IVA</label>
                        <select class="form-control" name="condicion_iva" id="condicion_iva" class="form-control">
                            <option value="">--Seleccionar--</option><br>
                            <option value="Responsable Inscripto">Responsable Inscripto</option>
                            <option value="Consumidor Final">Consumidor Final</option></select><br>
                        </div>
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('clientes.index') !!}" class="btn btn-danger">Cancelar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
