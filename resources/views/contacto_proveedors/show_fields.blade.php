<!-- Proveedor Id Field -->
{!! Form::label('proveedor_id', 'Proveedor:') !!}
{!! $contactoProveedor->proveedor->razonsocial !!}<br>

<!-- Tipocontacto Id Field -->
{!! Form::label('tipocontacto_id', 'Tipocontacto Id:') !!}
{!! $contactoProveedor->tipocontacto->contacto_descripcion!!}<br>

<!-- Contac Descripcion Field -->
{!! Form::label('contac_descripcion', 'Contac Descripcion:') !!}
{!! $contactoProveedor->contac_descripcion !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha de Alta:') !!}
{!! $contactoProveedor->created_at !!}<br>


<!-- Updated At Field -->
{!! Form::label('updated_at', 'Fecha de Modificacion:') !!}
{!! $contactoProveedor->updated_at !!}<br>











