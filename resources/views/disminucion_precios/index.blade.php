@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Disminucion Por Producto
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
            <h3>Disminucion de precio por producto
             
              <a href="{{route('disminucionPrecios.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('disminucion_precios.search')
           
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
           <table class="table table-responsive" id="disminucionPrecios-table">
    <thead>
       <tr>
            <th>Cod.Producto</th>
           
            
        <th>Usuario</th>
        <th>Fecha Hora</th>
        <th>Disminucion $</th>
        <th colspan="3">Action</th> 
    
        </tr>
    </thead>
    <tbody>
    @foreach($disminucionPrecios as $disminucionPrecio)
        <tr>
             <td>{!! $disminucionPrecio->barcode !!}-{!! $disminucionPrecio->descripcion !!}
               
            </td>
            
           
            <td>{!! $disminucionPrecio->name !!}</td>
            <td>{!! $disminucionPrecio->fecha_hora !!}</td>
            <td>{!! $disminucionPrecio->disminucion !!}</td>
             <td>
               <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
            </td>
            {{--<td>
                {!! Form::open(['route' => ['disminucionPrecios.destroy', $disminucionPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('disminucionPrecios.show', [$disminucionPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('disminucionPrecios.edit', [$disminucionPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
</div>
  {{ $disminucionPrecios->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

