<div class="form-group col-sm-6">
   <label for="categoria_id">Categorias</label>
  <select  type="text" name="categoria_id" class="form-control" id="categoria_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($categorias as $categoria)
    <option value="{{ $categoria->id }}">{{ $categoria->categoria_descripcion }}</option>
    @endforeach
  </select><br>
</div>


<div class="form-group col-sm-6">
   <label for="user_id">Vendedor</label>
      <select class="form-control" name="user_id" id="user_id" class="form-control">
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

<!-- Aumento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aumento', 'Aumento en $:') !!}
    {!! Form::number('aumento', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('aumentoPrecios.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
