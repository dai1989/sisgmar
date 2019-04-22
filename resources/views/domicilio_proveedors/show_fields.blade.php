<!-- Proveedor Id Field -->
{!! Form::label('proveedor_id', 'Proveedor Id:') !!}
{!! $domicilioProveedor->proveedor->razonsocial !!}<br>
<!-- Localidad Id Field -->
{!! Form::label('localidad_id', 'Localidad:') !!}
{!! $domicilioProveedor->localidad->localidad_descripcion !!}<br>


<!-- Provincia Id Field -->
{!! Form::label('provincia_id', 'Provincia Id:') !!}
{!! $domicilioProveedor->provincia->descripcion !!}<br>


<!-- Calle Field -->
{!! Form::label('calle', 'Calle:') !!}
{!! $domicilioProveedor->calle !!}<br>


<!-- Calle Numero Field -->
{!! Form::label('calle_numero', 'Calle Numero:') !!}
{!! $domicilioProveedor->calle_numero !!}<br>


<!-- Descripcion Field -->
{!! Form::label('descripcion', 'Descripcion:') !!}
{!! $domicilioProveedor->descripcion !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha de Alta:') !!}
{!! $domicilioProveedor->created_at !!}<br>


<!-- Updated At Field -->
{!! Form::label('updated_at', 'Fecha de Modificacion:') !!}
{!! $domicilioProveedor->updated_at !!}<br>




