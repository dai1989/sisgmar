@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Cuenta Cte 
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
            <h3>Listado de Ventas a Cta Cte
             
              <a href="{{route('mensual.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('mensual.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="mensual-table">
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
    @foreach ($mensual as $men)
        <tr>
            <td>{{ date("d-m-Y", strtotime($men->fecha_hora))}}</td>
            <td>{{ $men->nombre}},{{$men->apellido}}</td>
           <td>{{ $men->descripcion.': '.$men->num_comprobante}}</a></td>
           <td>{{ $men->impuesto}}</td>
           <td>{{ $men->total_venta}}</td>
            <td>@if($men->estado == "Cancelado")
            <span class="label label-danger">{{ $men->estado}}</span>
            @else
            <span class="label label-success">{{ $men->estado}}</span>
            @endif</td>
            <td>
                {!! Form::open(['route' => ['mensual.destroy', $men->idmensual], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('mensual.show', [$men->idmensual]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                     <a href="{{ url('mensual/pdf/' . $men->idmensual) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                    <a href="" data-target="#modal-delete-{{$men->idmensual}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                     
                </td>
            </tr>
            @include('mensual.modal')
            @include('mensual.modalcliente')
            @endforeach
        </tbody>
    </table>
</div>
 {{ $mensual->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

