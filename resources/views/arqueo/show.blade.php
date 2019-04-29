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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="show" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <th>Hora</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Total</th>
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
                {data: 'total', name: 'total'}
                // {data: 'opcion', name: 'opcion', orderable: false, searchable: false}
            ],
            "language": {
                "url": "{{URL::to('/')}}/admin/Spanish.json"
            }
        });
    </script>
@endsection