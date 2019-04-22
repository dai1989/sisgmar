@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Devolución de productos.
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
            <h3>Otras salidas.
             
              <a href="{{route('devolucionproducto.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('devolucionproducto.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="devolucionproducto-table">
    <thead>
        <tr>
            
          <th>Fecha</th>
          <th>Producto</th>
          <th>Causa</th>
          <th>T.Perdida</th>
          
          <th>Estado</th>
          <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($devolucionproductos as $devo)
        <tr>
            <td>{{date("d-m-Y", strtotime($devo->fecha_hora))}}</td>
            
           <td>{{$devo->barcode}}-{{ $devo->descripcion}}</a></td>
           <td>{{ $devo->observacion}}</a></td>
           <td>{{ $devo->total_venta}}</td>
           <td>@if($devo->estado == "Efectuado")
            <span class="label label-success">{{ $devo->estado}}</span>
            @else
            <span class="label label-danger">{{ $devo->estado}}</span>
            @endif
            </td>
            <td>
                
                <div class='btn-group'>
                    <a href="{!! route('devolucionproducto.show', [$devo->iddevolucionproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ url('devolucionproducto/pdf/' . $devo->iddevolucionproducto) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                   
                   
                   
                </td>
            </tr>
           
            @endforeach
        </tbody>
    </table>
</div>
 {{ $devolucionproductos->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

