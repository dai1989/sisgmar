<div class="form-group col-sm-6">
   <label for="marca_id">Marcas</label>
      <select class="form-control" name="marca_id" id="marca_id" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($marcas as $marca)
    <option value="{{ $marca->id }}">{{ $marca->marca_descripcion }}</option>
    @endforeach
  </select><br>
</div>
<div class="form-group col-sm-6">
   <label for="user_id">Vendedor</label>
  <select  type="text" name="user_id" class="form-control" id="user_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
  </select><br>
</div>
<!-- Fecha Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hora', 'Fecha Hora:') !!}
    {!! Form::date('fecha_hora', null, ['class' => 'form-control']) !!}
</div>

<!-- Disminucion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('disminucion', 'Disminucion en $:') !!}
    {!! Form::number('disminucion', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('disminucionMarcaPrecios.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
