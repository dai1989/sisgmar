@extends('layouts.app')
@section('content')
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<h3>Editar Cliente: {{$persona->nombre}} </h3>
						@if (count($errors)>0)
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
				</div>
				{!!Form::model($persona,['route'=>['cliente.update', $persona->idpersona] , 'method'=>'PATCH'])!!}
				{{Form::token()}}
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" required value="{{$persona->nombre}}" name="nombre" class="form-control">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="direccion">Tipo de Cliente</label>
							<select class="form-control" name="tipo_persona">
								@if($persona->tipo_persona == 'Cliente')
									<option value="Cliente" selected>Cliente</option>
									<option value="Cliente Cuenta Corriente">Cliente Cuenta Corriente</option>
								@else
									<option value="Cliente">Cliente</option>
									<option value="Cliente Cuenta Corriente" selected>Cliente Cuenta Corriente</option>
								@endif
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="direccion">Dirección</label>
							<input type="text" required value="{{$persona->direccion}}" name="direccion" class="form-control">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Documento</label>
							<select name="tipo_documento" class="form-control">
								@if($persona->tipo_documento == 'DNI')
									<option value="DNI" selected>DNI</option>
									<option value="RUC">RUC(Personas Juridicas)</option>
								@else
									<option value="DNI">DNI</option>
									<option value="RUC" selected>RUC(Personas Juridicas)</option>
								@endif
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="num_documento">Número documento</label>
							<input type="text" value="{{$persona->num_documento}}" name="num_documento" class="form-control">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="telefono">Teléfono</label>
							<input type="text" value="{{$persona->telefono}}" name="telefono" class="form-control" placeholder="Teléfono...">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" value="{{$persona->email}}" name="email" class="form-control" placeholder="Email...">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<button class="btn btn-primary btn-sm" type="submit">Guardar</button>
							<button class="btn btn-danger btn-sm" type="reset">Cancelar</button>
						</div>
					</div>
				</div>
				{!!Form::close()!!}
			</div>
		</div>
	</section>
@endsection
