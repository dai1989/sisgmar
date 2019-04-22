@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Compras
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
            <h3>Listado de Ingresos
             
              <a href="{{route('ingreso.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('ingreso.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="ingreso-table">
    <thead>
        <tr>
            
            <th>Proveedor</th>
            <th>N° Comprobante</th>
            <th>Impuesto</th>
            <th>Total</th>
            <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($ingresos as $ing)
        <tr>
            <td>{{ $ing->razonsocial}}</td>
            <td> {{$ing->num_comprobante}}</td>
            <td>{{ $ing->impuesto}}</td>
            <td>{{number_format( $ing->total, 2, '.', '')}}</td>
            <td>@if($ing->estado == "Anulado")
            <span class="label label-danger">{{ $ing->estado}}</span>
            @else
            <span class="label label-success">{{ $ing->estado}}</span>
            @endif</td>
            <td>
                {!! Form::open(['route' => ['ingreso.destroy', $ing->idingreso], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ingreso.show', [$ing->idingreso]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ url('ingreso/pdf/' . $ing->idingreso) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                    <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @include('ingreso.modal')
            @include('ingreso.modalproveedor')
            @endforeach
        </tbody>
    </table>
</div>
 {{ $ingresos->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

