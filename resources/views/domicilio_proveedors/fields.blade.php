<!-- Persona Id Field -->
<div class="form-group col-sm-6">
   <label for="proveedor_id">Proveedor</label>
  <select  type="text" name="proveedor_id" class="form-control" id="proveedor_id" placeholder="clientes" >
    <option value="">--Seleccionar--</option>
    @foreach ($proveedor_list as $proveedor)
    <option value="{{ $proveedor->id }}">{{ $proveedor->razonsocial }}</option>
    @endforeach
  </select>
</div>
<!-- Calle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calle', 'Calle:') !!}
    {!! Form::text('calle', null, ['class' => 'form-control']) !!}
</div>

<!-- Calle Numero Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calle_numero', 'Calle Numero:') !!}
    {!! Form::text('calle_numero', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipodomicilio Id Field
<div class="form-group col-sm-6"> 
   <label for="tipodomicilio_id">Tipo de Domicilio</label>
  <select  type="text" name="tipodomicilio_id" class="form-control" id="tipodomicilio_id" placeholder="Tipo de domicilio" >
    <option value="">--Seleccionar--</option>
    @foreach ($tipodomicilio_list as $tipodomicilio)
    <option value="{{ $tipodomicilio->id }}">{{ $tipodomicilio->tipo_descripcion }}</option>
    @endforeach
  </select>
</div>-->



<!-- Localidad Id Field -->
<div class="form-group col-sm-6">
   <label for="localidad_id">Localidad</label>
  <select  type="text" name="localidad_id" class="form-control" id="localidad_id" placeholder="localidad" >
    <option value="">--Seleccionar--</option>
    @foreach ($localidad_list as $localidad)
    <option value="{{ $localidad->id }}">{{ $localidad->localidad_descripcion }}</option>
    @endforeach
  </select>
</div>

<!-- Provincia Id Field -->
<div class="form-group col-sm-6">
    <label for="provincia_id">Provincia</label>
  <select  type="text" name="provincia_id" class="form-control" id="provincia_id" placeholder="provincia" >
    <option value="">--Seleccionar--</option>
    @foreach ($provincia_list as $provincia)
    <option value="{{ $provincia->id }}">{{ $provincia->descripcion }}</option>
    @endforeach
  </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('domicilioProveedors.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
