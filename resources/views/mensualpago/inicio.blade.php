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
                        <h3>Listado de pagos</h3>
                        @include('mensualpago.search')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Fecha de Pago</th>
                                    <th>Cliente</th>
                                    <th>Número de Cuenta</th>
                                    <th>Monto Pagado</th>
                                   
                                </thead>
                                @foreach ($mensualpago as $ven)
                                    <tbody>
                                    <tr>
                                        <td>{{ date("d-m-Y", strtotime($ven->fecha_hora))}}</td>
                                        <td>{{$ven->nombre}},{{$ven->apellido}}</td>
                                        <td>{{$ven->num_comprobante}}</td>
                                        <td>{{$ven->monto}}</td>
                                        
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div>
                     <div class="form-group col-sm-12">
                        <a href="/sisgmar/public/mensual" class="btn btn-info">Regresar</a>
            
            </div>
                </div>
                        {{$mensualpago->render()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection