
<!-- Fecha Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hora', 'Fecha Inicial:') !!}
    {!! Form::date('fecha_hora', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
   <label for="proveedor_id">Proveedor</label>
  <select  type="text" required name="proveedor_id" class="form-control" id="proveedor_id" placeholder="clientes" >
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

<!-- Fecha Cobro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_cobro', 'Fecha Cobro Aprox:') !!}
    {!! Form::date('fecha_cobro', null, ['class' => 'form-control']) !!}
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
