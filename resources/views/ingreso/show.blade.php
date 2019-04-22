@extends('adminlte::layouts.app')
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="proveedor">Proveedor</label>
                            <p>{{$ingreso->razonsocial}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Tipo Comprobante</label>
                            <p>{{$ingreso->descripcion}}</p>
                        </div>
                    </div>
                     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>N° Comprobante</label>
                            <p>{{$ingreso->num_comprobante}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="num_comprobante">Fecha</label>
                            <p>{{date("d-m-Y", strtotime($ingreso->fecha_hora))}}</p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>Fecha</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                    <th class="text-derecha"><h4 id="total">{{number_format($ingreso->total, 2, '.', '')}}</h4></th>
                                </tfoot>
                                <tbody>
                                    @foreach($detalles as $det)
                                        <tr>
                                            <td>{{date("d-m-Y", strtotime($det->created_at))}}</td>
                                            <td>{{$det->producto}}</td>

                                            <td class="text-derecha">{{$det->cantidad}}</td>
                                            <td class="text-derecha">{{$det->precio_compra}}</td>
                                            
                                            <td class="text-derecha">{{number_format($det->cantidad*$det->precio_compra, 2, '.', '')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
            <div class="form-group col-sm-12">
            <a href="{!! route('ingreso.index') !!}" class="btn btn-info">Regresar</a>
            </div>
        </div>
            </div>
        </div>
    </section>
    {!!Form::close()!!}
@endsection
