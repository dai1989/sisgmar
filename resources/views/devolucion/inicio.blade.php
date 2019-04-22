@extends('adminlte::layouts.app')
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="container-fluit">
                    @include('flash::message')
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Listado de Devoluciones</h3>
                        @include('devolucion.search')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Fecha de Devolucion</th>
                                    <th>Cliente</th>
                                    <th>Número de Devolución</th>
                                    <th>Número de Factura</th>
                                    <th>Opciones</th>
                                </thead>
                                @foreach ($devolucion as $ven)
                                    <tbody>
                                    <tr>
                                        <td>{{ date("d-m-Y", strtotime($ven->fecha_devolucion))}}</td>
                                        <td>{{$ven->nombre}},{{$ven->apellido}}</td>
                                        <td>{{$ven->num_comprobante}}</td>
                                        <td>{{$ven->num_factura}}</td>
                                         <td>
                                            <a href="{!! route('devolucion.show', [$ven->iddevolucion]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <a href="{{ url('devolucion/pdf/' . $ven->iddevolucion) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                       {{ $devolucion->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection