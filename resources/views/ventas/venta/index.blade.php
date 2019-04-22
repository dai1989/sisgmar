@extends('layouts.app')
@section('content')
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<div class="container-fluit">
						@include('flash::message')
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3>Listado de Ventas
							<a href="{{route('venta.create')}}"><button class="btn btn-success">Nuevo</button></a>
						</h3>
						@include('ventas.venta.search')
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
								@foreach ($ventas as $ven)
									<tbody>
										<tr>
											<td>{{ date("d-m-Y", strtotime($ven->fecha_hora))}}</td>
											<td id="toggle-button-{{$ven->idventa}}"><a href="#">{{ $ven->nombre}}</a></td>
											<td><a href="{{URL::action('VentaController@ticke', $ven->idventa)}}">{{ $ven->tipo_comprobante.': '.$ven->num_comprobante}}</a></td>
											<td>{{ $ven->impuesto}}</td>
												<td>{{ $ven->total_venta}}</td>
													<td>@if($ven->estado == "Sin Revisar")
														<span class="label label-danger">{{ $ven->estado}}</span>
													@else
														<span class="label label-info">{{ $ven->estado}}</span>
													@endif
												</td>

													<td>
														@ability('venta_editar,venta_todo,sistema_entero','venta_editar,venta_todo,sistema_entero')
														<a href="{{URL::action('VentaController@show', $ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
														@endability
														@ability('venta_borrar,venta_todo,sistema_entero','venta_borrar,venta_todo,sistema_entero')
														<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal" ><button class="btn btn-danger">Anular</button></a>
														@endability
													</td>
												</tr>
											</tbody>
											@include('ventas.venta.modal')
											@include('ventas.venta.modalcliente')
										@endforeach
									</table>
								</div>
						{{ $ventas->appends(request()->input())->links() }}
							</div>
						</div>
					</div>
				</div>
			</section>
		@endsection
