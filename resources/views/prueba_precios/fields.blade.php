<div class="form-group col-sm-6">
   <label for="idproducto">Productos</label>
      <select class="form-control" name="idproducto" id="idproducto" class="form-control">
    <option value="">--Seleccionar--</option><br>
    @foreach ($productos as $producto)
    
    <option value="{{ $producto->idproducto }}">{{ $producto->barcode }},{{$producto->descripcion}}</option>
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
<div class="form-group col-sm-6">
   <label for="categoria_id">Tipo de Contacto</label>
  <select  type="text" name="categoria_id" class="form-control" id="categoria_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($categorias as $categoria)
    <option value="{{ $categoria->id }}">{{ $categoria->categoria_descripcion }}</option>
    @endforeach
  </select><br>
</div>

<div class="form-group col-sm-6">
   <label for="marca_id">Marca</label>
  <select  type="text" name="marca_id" class="form-control" id="marca_id" placeholder="tipo de contacto" >
    <option value="">--Seleccionar--</option><br>
    @foreach ($marcas as $marca)
    <option value="{{ $marca->id }}">{{ $marca->descripcion }}</option>
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
    {!! Form::label('aumento', 'Aumento:') !!}
    {!! Form::number('aumento', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('pruebaPrecios.index') !!}" class="btn btn-default">Cancelar</a>
</div>
