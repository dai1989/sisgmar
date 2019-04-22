@extends('adminlte::layouts.app')
@section('content')
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="container-fluit">
					@include('flash::message')
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="proveedor">Cliente</label>
							<p>{{$devolucion->nombre}},{{$devolucion->apellido}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha de la devolución</label>
							<p>{{date("d-m-Y", strtotime($devolucion->fecha_devolucion))}}</p>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Número de Comprobante Devolución</label>
							<p>{{$devolucion->num_comprobante}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="num_comprobante">Número de Factura</label>
							<p>{{$devolucion->num_factura}}</p>
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
							 <table class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color: #A9D0F5">
									<th>Cod.Productos</th>
									<th>Cantidad</th>
									<th>Precio Venta</th>
									<th>Total Dev.</th>
									<th>Estado</th>
									<th>Observacion</th>
								</thead>
								<tbody>
									@foreach($detalles as $det)
										<tr>
											<td>{{$det->barcode}}-{{$det->descripcion}}</td>
											<td>{{$det->cantidad}}</td>
											<td>{{$det->precio_venta}}</td>
											<td>${{$det->precio_venta*$det->cantidad}}</td>
											<td>
												@if ($det->sube_resta == 'sumar')
												    Se incremento en el Stock
												@else
													No se incremento ni disminuyo en el stock
												@endif
											</td>
											
											<td>{{$det->observacion}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div>
					 <div class="form-group col-sm-12">
					 	<a href="/sisgmar/public/devolucion-inicio" class="btn btn-info">Regresar</a>
            
            </div>
				</div>
				
			</div>
		</div>
	</section>
	{!!Form::close()!!}




@endsection
