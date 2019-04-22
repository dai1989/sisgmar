@extends('adminlte::layouts.app')
@section('content')
	 <section class="content">
        <div class="box">
            <div class="box-header with-border">
                @include('flash::message')
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <div class="form-group">
							<label for="proveedor">Cliente</label>
							<p>{{$venta->nombre}},{{$venta->apellido}}</p>
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
                            <p>{{$venta->descripcion}}</p>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
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
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-derecha"><h4 id="total">{{$venta->total_venta}}</h4></th>
                                </tfoot>
                                <tbody>
                                @foreach($detalles as $det)
                                    <tr>
                                        <td>{{date("d-m-Y", strtotime($det->created_at))}}</td>
                                        <td>{{$det->producto}}</td>
                                        <td class="text-derecha">{{$det->cantidad}}</td>
                                        <td class="text-derecha">{{$det->precio_venta}}</td>
                                        <td class="text-derecha">{{number_format($det->descuento, 2, '.', '')}}</td>
                                        <td class="text-derecha">{{number_format($det->cantidad*$det->precio_venta-$det->descuento, 2, '.', '')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                <th>DD-MM-AAAA</th>
                                <th>Monto Abonado</th>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Total Abonado</th>
                                    <th class="text-derecha"><h4>{{$pago->sum('monto')}} $</h4></th>
                                </tr>
                                <tr>
                                    <th>Total que falta abonar</th>
                                    <th class="text-derecha"><h4>{{$venta->total_venta - $pago->sum('monto')}} $</h4>
                                    </th>
                                </tr>
                                </tfoot>
                                <tfoot>

                                </tfoot>
                                <tbody>
                                @foreach($pago as $ent)
                                    <tr>
                                        <td>{{date("d-m-Y", strtotime($ent->fecha_hora))}}</td>
                                        <td>{{$ent->monto}} $</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                       
                    </div>
                </div>
               <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('mensual.index') !!}" class="btn btn-info">Regresar</a>
            <button type="button" class="btn btn-success" data-toggle="modal"data-target="#cambiar">Entrega Dinero</button>
            </div>
        </div>
            </div>
        </div>
    </section>
    {!!Form::close()!!}
    <div class="modal fade" id="cambiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Pago a La cuenta corriente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['route'=>'pago.dinero', 'id'=>'agregar'  ,'method'=>'post', 'enctype'=>'multipart/form-data'])!!}

                    {{Form::token()}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="">Monto a Pagar</label>
                            <input type="text" name="monto" class="form-control">
                            <input type="hidden" name="idmensual" value="{{$venta->idmensual}}">
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" form="agregar" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
