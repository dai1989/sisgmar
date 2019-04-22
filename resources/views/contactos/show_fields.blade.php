<!-- Persona Id Field -->
{!! Form::label('persona_id', 'Cliente:') !!}
{!! $contacto->persona->nombre!!},{{$contacto->persona->apellido}}<br>


<!-- Tipocontacto Id Field -->
{!! Form::label('tipocontacto_id', 'Tipo de contacto:') !!}
{!! $contacto->tipocontacto->contacto_descripcion!!}<br>


<!-- Contac Descripcion Field -->
{!! Form::label('contac_descripcion', 'Contac Descripcion:') !!}
{!! $contacto->contac_descripcion !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha de Alta:') !!}
{!! $contacto->created_at !!}<br>


<!-- Updated At Field -->
{!! Form::label('updated_at', 'Fecha de Modificacion:') !!}
{!! $contacto->updated_at !!}<br>







