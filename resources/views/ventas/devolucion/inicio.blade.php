@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="container-fluit">
                    @include('flash::message')
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Listado de Devoluciones</h3>
                        @include('ventas.devolucion.search')
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
                                        <td>{{$ven->nombre}}</td>
                                        <td>{{$ven->num_comprobante}}</td>
                                        <td>{{$ven->num_factura}}</td>
                                        <td>
                                            <a href="{{route('devolucion.show', $ven->iddevolucion)}}"><button class="btn btn-success">Detalles de la Devolución</button></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        {{$devolucion->render()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection