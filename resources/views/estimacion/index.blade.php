@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Presupuesto
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
            <h3>Listado de Presupuestos
             
              <a href="{{route('estimacion.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('estimacion.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="estimacion-table">
    <thead>
        <tr>
            
          <th>Fecha</th>
		  <th>Impuesto</th>
		  <th>Total</th>
		  <th>Estado</th>
          <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($estimacion as $est)
        <tr>
            <td>{{date("d-m-Y", strtotime($est->fecha_hora))}}</td>
            
           <td>{{ $est->impuesto}}</a></td>
           <td>{{ $est->total_venta}}</td>
           <td>@if($est->estado == "Venta Realizada")
           	<span class="label label-info">{{ $est->estado}}</span>
			@else
			<span class="label label-danger">{{ $est->estado}}</span>
			@endif
			</td>
            <td>
                
                <div class='btn-group'>
                    <a href="{!! route('estimacion.show', [$est->idestimacion]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ url('estimacion/pdf/' . $est->idestimacion) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                    <a href="{{URL::action('EstimacionController@estimacionventa', $est->idestimacion)}}" class='btn btn-info btn-xs' ><i class="glyphicon glyphicon-shopping-cart"></i></a>
                   
                   
                </td>
            </tr>
           
            @endforeach
        </tbody>
    </table>
</div>
 {{ $estimacion->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

