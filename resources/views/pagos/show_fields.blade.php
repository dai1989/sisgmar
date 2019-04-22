

<!-- Fecha Hora Field -->
{!! Form::label('fecha_hora', 'Fecha Hora:') !!}
{!! $pago->fecha_hora !!}<br>


<!-- Proveedor Id Field -->
{!! Form::label('proveedor_id', 'Proveedor:') !!}
{!! $pago->proveedor->razonsocial!!}<br>


<!-- Medio Pago Field -->
{!! Form::label('medio_pago', 'Medio Pago:') !!}
{!! $pago->medio_pago !!}<br>


<!-- Num Cheque Field -->
{!! Form::label('num_cheque', 'Num Cheque/Comprobante:') !!}
{!! $pago->num_cheque !!}<br>


<!-- Monto Pedido Field -->
{!! Form::label('monto_pedido', 'Monto Pedido:') !!}
{!! $pago->monto_pedido !!}<br>


<!-- Fecha Cobro Field -->
{!! Form::label('fecha_cobro', 'Fecha Cobro:') !!}
{!! $pago->fecha_cobro !!}<br>


<!-- Estado Field -->
{!! Form::label('estado', 'Estado:') !!}
{!! $pago->estado !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha de alta:') !!}
{!! $pago->created_at !!}<br>


<!-- Updated At Field -->
{!! Form::label('updated_at', 'Fecha de modificacion:') !!}
{!! $pago->updated_at !!}<br>




