@extends('layouts.app')
@section('content')
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Cliente</h3>
            @if (count($errors)>0)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
        {!! Form::open(array('url' => 'ventas/cliente', 'method'=>'POST', 'autocomplete' => 'off'))!!}
        {{Form::token()}}
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" required value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre...">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="nombre">Tipo de Cliente</label>
              <select class="form-control" name="tipo_persona">
                <option value="Cliente">Cliente</option>
                <option value="Cliente Cuenta Corriente">Cliente Cuenta Corriente</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="nombre">Dirección</label>
              <input type="text" required value="{{old('direccion')}}" name="direccion" class="form-control" placeholder="Dirección...">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Documento</label>
              <select name="tipo_documento" class="form-control">
                <option value="DNI">DNI</option>
                <option value="RUC">RUC(Personas Juridicas)</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="num_documento">Número documento</label>
              <input type="text" value="{{old('num_documento')}}" name="num_documento" class="form-control" placeholder="Número de documento...">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="text" value="{{old('telefono')}}" name="telefono" class="form-control" placeholder="Teléfono...">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email...">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
              <button class="btn btn-danger btn-sm" type="reset">Cancelar</button>
            </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </section>
@endsection
