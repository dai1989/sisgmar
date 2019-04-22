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
						<h3>Listado de ventas mensuales
							@ability('ventamensual_crear,ventamensual_todo,sistema_entero','ventamensual_crear,ventamensual_todo,sistema_entero')
							<a href="{{route('mensual.create')}}"><button class="btn btn-success">Nuevo</button></a>
							@endability
						</h3>
						@include('ventas.mensual.search')
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Fecha</th>
									<th>Cliente</th>
									<th>Comprobante</th>
									<th>Impuesto</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Opciones</th>
								</thead>
								@foreach ($mensual as $men)
									<tbody>
										<tr>
											<td>{{ date("d-m-Y", strtotime($men->fecha_hora))}}</td>
										  <td id="toggle-button-{{$men->idmensual}}"><a href="#">{{ $men->nombre}}</a></td>
											<td>{{ $men->tipo_comprobante.': '. $men->num_comprobante}}</td>
											<td>{{ $men->impuesto}}</td>
											<td><strong>{{ $men->total_venta}}</strong></td>
											<td>@if($men->estado == "Anulada")
												<span class="label label-info">{{ $men->estado}}</span>
											@else
												<span class="label label-danger">{{ $men->estado}}</span>
											@endif
										</td>
										<td>
											@ability('ventamensual_editar,ventamensual_todo,sistema_entero','ventamensual_editar,ventamensual_todo,sistema_entero')
											<a href="{{URL::action('MensualController@show', $men->idmensual)}}"><button class="btn btn-primary btn-sm">Detalles</button></a>
											@endability
											@ability('ventamensual_borrar,ventamensual_todo,sistema_entero','ventamensual_borrar,ventamensual_todo,sistema_entero')
											<a href="" data-target="#modal-delete-{{$men->idmensual}}" data-toggle="modal" ><button class="btn btn-danger btn-sm">Anular</button></a>
											@endability
										</td>
									</tr>
								</tbody>
								@include('ventas.mensual.modal')
								@include('ventas.mensual.modalcliente')
							@endforeach
						</table>
					</div>
					{{$mensual->render()}}
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
