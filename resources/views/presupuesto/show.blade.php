@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Presupuesto
@endsection

@section('content')
   @php
    $date = Carbon\Carbon::now('America/Argentina/Salta');
  @endphp
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{$venta->fecha_hora}}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Vendedor</label>
							<p>{{$usuario->name}}</p>
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
										<th>Cantidad</th>
										<th>Precio Venta</th>
										<th>Descuento</th>
										<th>Subtotal</th>
									</thead>
									<tfoot>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th class="text-derecha"><h4 id="total">{{$venta->total_venta}}</h4></th>
									</tfoot>
									<tbody>

									@foreach($detalles as $det)
										<tr>
											<td>{{$det->created_at=$date->format('d-m-Y')}}</td>
                      <td>{{$det->producto}}</td>
											<td class="text-derecha">{{$det->cantidad}}</td>
											<td class="text-derecha">{{$det->precio_venta}}</td>
											<td class="text-derecha">{{number_format($det->descuento, 2, '.', '')}}</td>
											<td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}
                      </td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div>
						 <div class="form-group col-sm-12">
            <a href="{!! route('presupuesto.index') !!}" class="btn btn-info">Regresar</a>
            </div>	
					</div>


			{!!Form::close()!!}
		</div>
	</div>
</section>
@endsection
