@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Detalle de Presupuesto
@endsection

@section('content')
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{$devolucionproductos->fecha_hora}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Vendedor</label>
							<p>{{$user->name}}</p>
						</div>
					</div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color: #A9D0F5">
									<th>DD-MM-AAAA</th>
									<th>Productos</th>
									<th>Cant.Devolucion</th>
									<th>Precio Venta</th>
									
									<th>Subtotal</th>
								</thead>
								<tfoot>
									<th>Total Perdida</th>
									<th></th>
									<th></th>
									<th></th>
									
									<th class="text-derecha"><h4 id="total">{{$devolucionproductos->total_venta}}</h4></th>
									
								</tfoot>
								<tbody>
									@foreach($detalles as $det)
										<tr>
											<td>{{date("d-m-Y", strtotime($det->created_at))}}</td>
											<td>{{$det->producto}}</td>
											<td class="text-derecha">{{$det->cantidad}}</td>
											<td class="text-derecha">{{$det->precio_venta}}</td>
											
											<td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							{{--<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<td><div class="form-group">
							<label for="observacion">Observaciones</label>
							<p>{{$devolucionproductos->observacion}}</p>
						</div></td>
					</div>
							</table>--}}
						</div>
					</div>
				</div>
				  <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('devolucionproducto.index') !!}" class="btn btn-info">Regresar</a>
            
            </div>
        </div>
			</div>
		</div>
	</section>
	{!!Form::close()!!}
@endsection
