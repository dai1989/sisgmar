@extends('layouts.app')
@section('content')
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<div class="container-fluit">
						@include('flash::message')
				</div>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<h3>Listado de Clientes
							@ability('cliente_crear,cliente_todo,sistema_entero','cliente_crear,cliente_todo,sistema_entero')
							<a href="{{route('cliente.create')}}"><button class="btn btn-success">Nuevo</button></a>
							@endability
						</h3>
						@include('ventas.cliente.search')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Nombre</th>
									<th>Documentp</th>
									<th>Teléfono</th>
									<th>Tipo</th>
									<th>Email</th>
									<th>Opciones</th>
								</thead>
								@foreach ($personas as $per)
									<tbody>
										<tr>
											<td>{{ $per->nombre}}</td>
											<td>{{ $per->tipo_documento}}: {{ $per->num_documento}}</td>
											<td>{{ $per->telefono}}</td>
											<td>{{ $per->tipo_persona}}</td>
											<td>{{ $per->email}}</td>
											<td>
												@ability('cliente_editar,cliente_todo,sistema_entero','cliente_editar,cliente_todo,sistema_entero')
												<a href="{{URL::action('ClienteController@edit', $per->idpersona)}}"><button class="btn btn-primary">Editar</button></a>
												@endability
												@ability('cliente_borrar,cliente_todo,sistema_entero','cliente_borrar,cliente_todo,sistema_entero')
												<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal" ><button class="btn btn-danger">Borrar</button></a>
												@endability
											</td>
										</tr>
									</tbody>
									@include('ventas.cliente.modal')
								@endforeach
							</table>
						</div>
						{{$personas->render()}}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
