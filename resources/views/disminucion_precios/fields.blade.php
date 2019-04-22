<!-- Idproducto Field -->
<div class="form-group col-sm-6">
    <label>Producto</label>
    <select name="idproducto" class="form-control selectpicker" id="idproducto" data-live-search="true">
        <option value="0"></option>
        @foreach($productos as $producto)
        <option value="{{$producto->idproducto}}">{{$producto->barcode}}-{{$producto->descripcion}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    <label>Vendedor</label>
    <select name="user_id" class="form-control selectpicker" id="user_id" data-live-search="true">
        <option value="0"></option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</div>



<!-- Fecha Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_hora', 'Fecha Hora:') !!}
    {!! Form::date('fecha_hora', null, ['class' => 'form-control']) !!}
</div>

<!-- Aumento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('disminucion', 'Disminucion en $:') !!}
    {!! Form::number('disminucion', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('disminucionPrecios.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
