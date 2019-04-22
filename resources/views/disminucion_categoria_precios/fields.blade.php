<div class="form-group col-sm-6">
   <label for="categoria_id">Categorias</label>
      <select class="form-control" name="categoria_id" id="categoria_id" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($categorias as $categoria)
    <option value="{{ $categoria->id }}">{{ $categoria->categoria_descripcion }}</option>
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
    <a href="{!! route('disminucionCategoriaPrecios.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
