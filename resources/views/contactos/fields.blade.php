<div class="form-group col-sm-6">
   <label for="persona_id">Cliente</label>
      <select class="form-control" name="persona_id" id="persona_id" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($personas as $persona)
    <option value="{{ $persona->id }}">{{ $persona->nombre }},{{$persona->apellido}}</option>
    @endforeach
  </select><br>
</div>
<div class="form-group col-sm-6">
   <label for="tipocontacto_id">Tipo de Contacto</label>
  <select  type="text" name="tipocontacto_id" class="form-control" id="tipocontacto_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($tipocontactos as $tipo_contacto)
    <option value="{{ $tipo_contacto->id }}">{{ $tipo_contacto->contacto_descripcion }}</option>
    @endforeach
  </select><br>
</div>
<!-- Contac Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contac_descripcion', 'Contac Descripcion:') !!}
    {!! Form::text('contac_descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('contactos.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
