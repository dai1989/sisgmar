@extends('layouts.app')
@section('content')
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="proveedor">Cliente</label>
							<p>{{$venta->nombre}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{date("d-m-Y", strtotime($venta->fecha_hora))}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Vendedor</label>
							<p>{{$usuario->name}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Tipo Comprobante</label>
							<p>{{$venta->tipo_comprobante}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="num_comprobante">Número Comprobante</label>
							<p>{{$venta->num_comprobante}}</p>
						</div>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
							<table  class="table table-bordered">
							 <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color: #A9D0F5">
									<th>DD-MM-AAAA</th>
									<th>Artículos</th>
									<th>Cantidad</th>
									<th>Precio Venta</th>
									<th>Descuento</th>
									<th>Subtotal</th>
								</thead>
								<tbody>
									@foreach($detalles as $det)
										<tr>
											<td>{{date("d-m-Y", strtotime($det->created_at))}}</td>
											<td>{{$det->articulo}}</td>
											<td class="text-derecha">{{$det->cantidad}}</td>
											<td class="text-derecha">{{$det->precio_venta}}</td>
											<td class="text-derecha">{{number_format($det->descuento, 2, '.', '')}}</td>
											<td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}</td>
										</tr>
									@endforeach
								</tbody>
								<tbody>
									<th>TOTAL</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th class="text-derecha" ><h4>{{number_format($venta->total_venta, 2, '.', '')}}</h4></th>
								</tbody>
								<tbody>
									<th>PAGA</th>
									<th></th>
									<th class="text-derecha" ><h5>Debito: {{$venta->tarjeta_debito}} $</h5></th>
									<th class="text-derecha" ><h5>Credito: {{$venta->tarjeta_credito}} $</h5></th>
									<th class="text-derecha" ><h5>Efectivo: {{$venta->paga}} $</h5></th>
									<th class="text-derecha" ><h4>Total: {{$venta->paga + $venta->tarjeta_credito + $venta->tarjeta_debito}}  $</h4></th>

								</tbody>
								<tbody>
									<th>CAMBIO</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th class="text-derecha"><h4>{{number_format($venta->paga + $venta->tarjeta_credito + $venta->tarjeta_debito - $venta->total_venta, 2, '.', '')}}</h4></th>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div>
					<a href="{{URL::action('PDFController@venta', $venta->idventa)}}"><button class="btn btn-info ">Descargar PDF</button></a>
					<a href="" data-target="#modal-devo" data-toggle="modal" ><button class="btn btn-success">Devolución de Productos</button></a>
				</div>
			</div>
		</div>
	</section>
	{!!Form::close()!!}
	<div class="modal modal-info" aria-hidden="true" role="dialog" tabindex="-1" id="modal-devo">

		{!! Form::open(array('route' => 'devolucion.store', 'method'=>'POST','autocomplete' => 'off')) !!}
		{{Form::token()}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden='true'>x</span>
					</button>
					<h4 class="modal-title" >Devolución de productos del cliente: {{$venta->nombre}}</h4>
				</div>
				<div class="modal-body" style="background-color: #ffffff !important;color: black !important;">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Artículos</th>
							<th>Cantidad</th>
							<th>Resta o Suma Stock</th>
							<th>Descripción</th>
						</thead>
						@foreach($detalles as $det)
							<tr>
								<td>{{$det->articulo}} <input type="hidden" name="idarticulo[]" value="{{$det->idarticulo}}"></td>
								<td class="text-derecha"><input min="0" max="{{$det->cantidad}}" class="form-control" type="number" value="{{$det->cantidad}}" name="cantidad[]"></td>
								<td class="text-derecha">
									<select name="suma_resta[]" class="form-control">
										<option value="sumar">Sumar al Stock</option>
										<option value="restar">No sumar al Stock</option>
									</select>
								</td>
								<td><textarea class="form-control" name="descripcion[]" rows="3">

									</textarea></td>
							</tr>
						@endforeach
					</table>

					<input name="num_factura" value="{{$venta->num_comprobante}}" type="hidden">
					<input name="idcliente" value="{{$venta->idpersona}}" type="hidden">
					<input name="num_comprobante" value="{{count($devo) + 1}}" type="hidden">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>
			</div>
		</div>
		{{Form::Close()}}

	</div>

@endsection
