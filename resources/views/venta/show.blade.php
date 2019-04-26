@extends('adminlte::layouts.app')

@section('htmlheader_title')
    venta
@endsection

@section('content')

        
   <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="persona_id">Cliente</label>
                            <p>{{$venta->nombre}},{{$venta->apellido}}</p>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label for="persona_id">Documento</label>
                            <p>{{$venta->documento}}</p>
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
                            <p>{{$user->name}}</p>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  table-responsive">
                            <table  class="table table-bordered">
                             <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>DD-MM-AAAA</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody>
                                    @foreach($detalles as $det)
                                        <tr>
                                            <td>{{date("d-m-Y", strtotime($venta->fecha_hora))}}</td>
                                            <td>{{$det->producto}}</td>
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
                                    <th>Efectivo</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha" ><h4>{{number_format($venta->entrega,2,'.','')}}</h4></th>
                                </tbody>
                                 <tbody>
                                    <th>Tarjeta de Credito</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha" ><h4>{{number_format($venta->pago_tarjeta,2,'.','')}}</h4></th>
                                </tbody>
                                 <tbody>
                                    <th>Tarjeta de Debito</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-derecha" ><h4>{{number_format($venta->debito,2,'.','')}}</h4></th>
                                </tbody>
                                  <tbody>
                                    <th>Nota de credito</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th> 
                                    <th>@if($venta->descripcionpago == "Nota de credito")
                                        <span class="text-derecha"><h4> {{number_format($venta->total_venta, 2, '.', '')}}</span>
                                            @else
                                            <span class="text-derecha"><h4>0.00</span>
                                        @endif</h4></th>
                                </tbody>
                                <tbody>
                                    <th>CAMBIO</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>@if($venta->descripcionpago == "Efectivo")
                                        <span class="text-derecha"><h4> {{number_format($venta->entrega - $venta->total_venta, 2, '.', '')}}</span>
                                            @else
                                            <span class="text-derecha"><h4> {{number_format($venta->entrega - $venta->entrega, 2, '.', '')}}</span>
                                        @endif</h4></th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                     <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('venta.index') !!}" class="btn btn-info">Regresar</a>
            <a href="" data-target="#modal-devo" data-toggle="modal" ><button class="btn btn-success">Devolución de Productos</button></a>
            </div>
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
                    <h4 class="modal-title" >Devolución de productos del cliente: {{$venta->nombre}},{{$venta->apellido}}</h4>
                </div>
                <div class="modal-body" style="background-color: #ffffff !important;color: black !important;">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Productos</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                            <th>Disminuye o Incrementa Stock</th>
                            <th>Observacion</th>
                        </thead>
                        @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->producto}} <input type="hidden" name="idproducto[]" value="{{$det->idproducto}}"></td>
                                <td class="text-derecha"><input min="0" max="{{$det->cantidad}}" class="form-control" type="number" value="{{$det->cantidad}}" name="cantidad[]"></td>
                                <td class="text-derecha"><input min="0" max="{{$det->precio_venta}}" class="form-control" type="number" value="{{$det->precio_venta}}" name="precio_venta[]"></td>
                                <td class="text-derecha">
                                    <select name="suma_resta[]" class="form-control">
                                        <option value="sumar">Incrementa Stock</option>
                                        <option value="restar">No sumar al Stock</option>
                                    </select>
                                </td>
                                <td><textarea class="form-control" name="observacion[]" rows="3">

                                    </textarea></td>
                            </tr>
                        @endforeach
                    </table>

                    <input name="num_factura" value="{{$venta->num_comprobante}}" type="hidden">
                    <input name="total_venta" value="{{$venta->total_venta}}" type="hidden">
                    <input name="idcliente" value="{{$venta->id}}" type="hidden">
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