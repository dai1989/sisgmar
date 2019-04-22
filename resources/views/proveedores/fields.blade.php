<!-- Razonsocial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razonsocial', 'Razon social:') !!}
    {!! Form::text('razonsocial', null, ['class' => 'form-control']) !!}
</div>

<!-- Cuit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cuit', 'Cuit:') !!}
    {!! Form::text('cuit', null, ['class' => 'form-control']) !!}
</div>
<!-- Condicion iva Field -->
<div class="form-group col-sm-6">
	<label for="condicion_iva">Condicion frente al IVA</label>
	<select class="form-control" name="condicion_iva" id="condicion_iva" class="form-control">
		<option value="">--Seleccionar--</option><br>
		<option value="Responsable Inscripto">Responsable Inscripto</option>
		<option value="Consumidor Final">Consumidor Final</option></select><br>
                        </div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('proveedores.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
