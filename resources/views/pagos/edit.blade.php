@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Pago
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Pago
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pago, ['route' => ['pagos.update', $pago->id], 'method' => 'patch']) !!}
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label for="fecha_hora">Fecha Inicial</label>
        <input type="text" required  value="{{$pago->fecha_hora}}" name="fecha_hora" class="form-control">
      </div>
    </div>
    <div class="form-group col-sm-6">
   <label for="proveedor_id">Proveedor</label>
  <select  type="text" name="proveedor_id" class="form-control" id="proveedor_id" placeholder="clientes" >
    <option value="">--Seleccionar--</option>
    @foreach ($proveedores as $proveedor)
    <option value="{{ $proveedor->id }}">{{ $proveedor->razonsocial }}</option>
    @endforeach
  </select>
</div>
<!-- Medio Pago Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medio_pago', 'Medio Pago:') !!}
    {!! Form::text('medio_pago', null, ['class' => 'form-control']) !!}
</div>

<!-- Num Cheque Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num_cheque', 'Num Cheque/Comprobante:') !!}
    {!! Form::text('num_cheque', null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Pedido Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto_pedido', 'Monto del Pedido:') !!}
    {!! Form::text('monto_pedido', null, ['class' => 'form-control']) !!}
</div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label for="fecha_cobro">Fecha de cobro/Aprox</label>
        <input type="date" required  value="{{$pago->fecha_cobro}}" name="fecha_cobro" class="form-control">
      </div>
    </div>
    <!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pagos.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
{!! Form::close() !!}
</div>
  </div>
    </div>
      </div>
@endsection