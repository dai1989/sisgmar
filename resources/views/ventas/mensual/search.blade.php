{!! Form::open(array('url'=>'ventas/mensual', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText"  placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
