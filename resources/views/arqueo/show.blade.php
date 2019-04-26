@extends('adminlte::layouts.app')
@section('css')
   @include('layouts.datatables1_css')
    <style>
        table.dataTable tfoot th, table.dataTable tfoot td {
            padding: 0px 0px 0px 0px;
            border-top: 1px solid #111;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluit">
                    @include('flash::message')
                </div>
                 <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Detalle del Arqueo: {{date("d-m-Y", strtotime($arqueo->fecha_hora))}}  <a  href="#" data-toggle="modal" data-target="#agregar" class="btn btn-success"><i class="fa fa-edit"></i> Agrega Arqueo</a></h3>
                        <hr>
                    </div>
                </div>
                @include('arqueo.modal-agregar')
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>$ {{$arqueo->total_dia - $ingreso->sum('total') +$efectivo->sum('total') }}</h3>

                                <p>Total Capital</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbox"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>$ {{$inicio->total + $efectivo->sum('total')-$ingreso->sum('total')}}</h3>
                               

                                <p>Total en Caja</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbox"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                            
                                 <h3>$ {{$corriente->sum('total')}} </h3>
                                <p>Total ganado en cuenta Corriente</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbox"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                              <h3>$ {{$ingreso->sum('total')}}</h3>

                                <p>Total de Salidas $</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbox"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="show" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <th>Hora</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Total</th>
                                <th>Tipo de Pago</th>
                                <th>Tipo de Venta</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
 @include('layouts.datatables1_js')
    <script>

        $('#show').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('arqueo.show.tabla', $id)}}",
            columns: [
                {data: 'hora', name: 'hora'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'cantidad', name: 'cantidad'},
                {data: 'monto', name: 'monto'},
                {data: 'total', name: 'total'},
                {data: 'tipo_pago', name: 'tipo_pago'},
                {data: 'tipo_venta', name: 'tipo_venta'}
                // {data: 'opcion', name: 'opcion', orderable: false, searchable: false}
            ],
            "language": {
                "url": "{{URL::to('/')}}/admin/Spanish.json"
            }
        });
    </script>
@endsection