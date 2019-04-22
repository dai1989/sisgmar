@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Recaudacion
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
             <h3>Recaudación por ventas {{--<a href="{{route('presupuesto.create')}}"><button class="btn btn-success">Nuevo</button></a>--}}</h3>
            @include('presupuesto.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="mensual-table">
    <thead>
        <tr>
            
           <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
                  
           <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($presupuesto as $ven)
        <tr>
           <td>{{ date("d-m-Y", strtotime($ven->fecha_hora))}}</td>
                    <td><strong>{{ $ven->total_venta}}</strong></td>
                    <td>@if($ven->estado == "Efectuado")
                      <span class="label label-success">{{ $ven->estado}}</span>
                      @else
                      <span class="label label-danger">{{ $ven->estado}}</span>
                      @endif
                    </td>
                    <td> 
                       <a href="{{URL::action('PresupuestoController@show', $ven->idpresupuesto)}}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ url('presupuesto/pdf/' . $ven->idpresupuesto) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                        <a href="" data-target="#modal-delete-{{$ven->idpresupuesto}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                      </td>
            </tr>
            @include('presupuesto.modal')
           
            @endforeach
        </tbody>
    </table>
</div>
{{$presupuesto->render()}}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

