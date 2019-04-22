<div class="form-group col-sm-6">
   <label for="idproducto">Productos</label>
  <select  type="text" name="idproducto" class="form-control" id="idproducto" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($productos as $producto)
    <option value="{{ $producto->idproducto }}">{{$producto->barcode}}{{ $producto->descripcion }}</option>
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
    {!! Form::label('aumento', 'Aumento $:') !!}
    {!! Form::number('aumento', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('aumentoProductoPrecios.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
