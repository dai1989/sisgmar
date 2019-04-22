<!-- Idproducto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idproducto', 'Idproducto:') !!}
    {!! Form::number('idproducto', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Venta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_venta', 'Precio Venta:') !!}
    {!! Form::text('precio_venta', null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Anterior Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio_anterior', 'Precio Anterior:') !!}
    {!! Form::text('precio_anterior', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    <a href="{!! route('estadisticaPrecios.index') !!}" class="btn btn-default">Cancelar</a>
</div>
