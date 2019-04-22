@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')
@section('htmlheader_title')
    Crear presupuesto
@endsection

@section('content')
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="fecha_hora">Fecha</label>
							<p>{{$estimacion->fecha_hora}}</p>
						</div>
					</div>
					{!! Form::open(array('url' => 'crearventa', 'method'=>'POST', 'autocomplete' => 'off'))!!}
					{{Form::token()}}
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="form-group">
							<label for="persona_id">Cliente</label>
							<select name="persona_id" required class="form-control selectpicker" id="persona_id" data-live-search="true">
								<option></option>
								@foreach($personas as $persona)
									<option value="{{$persona->id}}">{{$persona->nombre}},{{$persona->apellido}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<input type="hidden" name="idestimacion" value="{{$estimacion->idestimacion}}">
					<input type="hidden" name="idusuario" value="{{Auth::user()->id}}">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="tipofactura_id">Tipo factura</label>
              <select  type="text" name="tipofactura_id" class="form-control" id="tipofactura_id" placeholder="tipo de factura" >
                <option value="">--Seleccionar--</option>
                @foreach ($tipofactura_list as $tipofactura)
                <option value="{{ $tipofactura->id }}">{{ $tipofactura->descripcion }}</option>
                @endforeach
              </select>
            </div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
             <label for="tipopago_id">Tipo de Pago</label>
                <select  type="text" name="tipopago_id" class="form-control" multiple="multiple"id="tipopago_id" placeholder="tipo de factura" >
                  <option value="">--Seleccionar--</option>
                  @foreach ($tipopago_list as $tipopago)
                  <option value="{{ $tipopago->id }}">{{ $tipopago->descripcionpago }}</option>
                  @endforeach
                </select>
            </div>
          </div>	
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="num_comprobante">Número Comprobante</label>
							@if ($ven == '1')
								<input type="text" readonly  value="0-0" name="num_comprobante" class="form-control" placeholder="Numero Comprobante">
							@else
								<input type="text" readonly  value="0-{{$ven->idventa}}" name="num_comprobante" class="form-control" placeholder="Numero Comprobante">
							@endif
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="entrega">Paga</label>
							<input type="number" class="form-control" value="0" placeholder="efectivo" min="0"  name="entrega">
						</div>

					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="pago_tarjeta">P.Tarjeta</label>
							<input type="number" class="form-control" value="0" placeholder="tarjeta credito" min="0"  name="pago_tarjeta">
						</div>
						
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="debito">P.Debito</label>
							<input type="number" class="form-control" value="0" placeholder="tarjeta debito" min="0"  name="debito">
						</div>
						
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color: #A9D0F5">
									<th>AAAA-MM-DD HH:MM:SS</th>
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
									<th class="text-derecha"><h4 id="total">{{$estimacion->total_venta}}</h4></th>
								</tfoot>
								<tbody>
									@foreach($detalles as $det)
										<tr>
											<td>{{$det->created_at}}</td>
											<td>{{$det->producto}}</td>
											<td class="text-derecha">{{$det->cantidad}}</td>
											<td class="text-derecha">{{$det->precio_venta}}</td>
											<td class="text-derecha">{{$det->descuento}}</td>
											<td class="text-derecha">{{number_format( $det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-12">
					{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
					<a href="{!! route('estimacion.index') !!}" class="btn btn-danger">Cancelar</a>
				</div>
				
				
				{{Form::token()}}
				
			</div>
		</div>
	</section>
	{!!Form::close()!!}
	@push('scripts')
<script>
    $(function () {
        $("#tipopago_id").select2();

        var $input = $("#files");
        $input.fileinput({
            {{--uploadUrl: "{{route('api.temp_files.multi_store',Auth::user()->id)}}", // server upload action--}}
//            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false, // hide remove button
//            minFileCount: 1,
//            maxFileCount: 5,
            allowedFileExtensions: ["png","bmp","gif","jpg","pdf"],
        });
    })
</script>
@endpush
@endsection
