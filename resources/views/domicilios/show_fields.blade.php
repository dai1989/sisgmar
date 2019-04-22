<!-- Persona Id Field -->
{!! Form::label('persona_id', 'Cliente:') !!}
{!! $domicilio->persona->nombre!!},{{$domicilio->persona->apellido}}<br>

<!-- Tipodomicilio Id Field -->
{!! Form::label('tipodomicilio_id', 'Tipo de domicilio:') !!}
{!! $domicilio->tipodomicilio->tipo_descripcion !!}<br>


<!-- Localidad Id Field -->
{!! Form::label('localidad_id', 'Localidad:') !!}
{!! $domicilio->localidad->localidad_descripcion !!}<br>


<!-- Provincia Id Field -->
{!! Form::label('provincia_id', 'Provincia:') !!}
{!! $domicilio->provincia->descripcion !!}<br>


<!-- Calle Field -->
{!! Form::label('calle', 'Calle:') !!}
{!! $domicilio->calle !!}<br>


<!-- Calle Numero Field -->
{!! Form::label('calle_numero', 'Calle Numero:') !!}
{!! $domicilio->calle_numero !!}<br>


<!-- Descripcion Field -->
{!! Form::label('descripcion', 'Descripcion:') !!}
{!! $domicilio->descripcion !!}<br>


<!-- Created At Field -->
{!! Form::label('created_at', 'Fecha de Alta:') !!}
{!! $domicilio->created_at !!}<br>


<!-- Updated At Field -->
{!! Form::label('updated_at', 'Fecha de Modificacion:') !!}
{!! $domicilio->updated_at !!}<br>








