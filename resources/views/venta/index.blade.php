@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Ventas
@endsection

@section('content')
  <section class="content">
     <div class="box box-primary">
      <div class="box-header with-border">
        <div class="container-fluit">
          @include('flash::message')
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de Ventas
             
              <a href="{{route('venta.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('venta.search')
           
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="venta-table">
    <thead>
        <tr>
            
           <th>Fecha</th>
           <th>Cliente</th>
           <th>Comprobante</th>
           <th>Impuesto</th>
           <th>Total</th>
           <th>Estado</th>
           <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($ventas as $ven)
        <tr>
            <td>{{ date("d-m-Y", strtotime($ven->fecha_hora))}}</td>
            <td>{{ $ven->nombre}},{{$ven->apellido}}</td>
           <td>{{ $ven->descripcion.': '.$ven->num_comprobante}}</a></td>
           <td>{{ $ven->impuesto}}</td>
           <td>{{ $ven->total_venta}}</td>
            <td>@if($ven->estado == "Anulada")
            <span class="label label-danger">{{ $ven->estado}}</span>
            @else
            <span class="label label-success">{{ $ven->estado}}</span>
            @endif</td>
            <td>
                {!! Form::open(['route' => ['venta.destroy', $ven->idventa], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('venta.show', [$ven->idventa]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ url('venta/pdf/' . $ven->idventa) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                    
                    <a href="{{URL::action('VentaController@ticke', $ven->idventa)}}"class='btn btn-info btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                     <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @include('venta.modal')
            @include('venta.modalcliente')
            @endforeach
        </tbody>
    </table>
</div>
  {{ $ventas->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

