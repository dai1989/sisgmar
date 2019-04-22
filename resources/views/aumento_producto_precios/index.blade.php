@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Aumento Por Producto
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
            <h3>Aumento de precio por producto
             
              <a href="{{route('aumentoProductoPrecios.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('aumento_producto_precios.search')
           
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table table-responsive" id="aumentoProductoPrecios-table">
    <thead>
        <tr>
           <th>Fecha Hora</th>
            <th>Producto</th>
        <th>Vendedor</th>
       
        <th>Aumento $</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($aumentoProductoPrecios as $aumentoProductoPrecio)
        <tr>
            <td>{!! $aumentoProductoPrecio->fecha_hora !!}</td>
            <td>{{$aumentoProductoPrecio->barcode}}-{!! $aumentoProductoPrecio->descripcion !!}</td>
            <td>{!! $aumentoProductoPrecio->name !!}</td>
            <td>{!! $aumentoProductoPrecio->aumento !!}</td>
            <td>
                 <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
                {{--{!! Form::open(['route' => ['aumentoProductoPrecios.destroy', $aumentoProductoPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('aumentoProductoPrecios.show', [$aumentoProductoPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('aumentoProductoPrecios.edit', [$aumentoProductoPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
  {{ $aumentoProductoPrecios->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

