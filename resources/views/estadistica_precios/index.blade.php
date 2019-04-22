@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Variacion de precios
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
            <h3>Variacion de subas y bajas de precio venta</h3>
            @include('estadistica_precios.search')
           
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table table-responsive" id="estadisticaPrecios-table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Cod.Producto</th>
            <th>Categoria</th>
            <th>Marca</th>
        <th>Precio Venta</th>
        <th>Precio Anterior</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($estadisticaPrecios as $estadisticaPrecio)
        <tr>
            <td>{!! $estadisticaPrecio->fecha_hora !!}</td>
            <td>{{$estadisticaPrecio->barcode}}-{!! $estadisticaPrecio->descripcion !!}</td>
            <td>{!! $estadisticaPrecio->categoria_descripcion !!}</td>
            <td>{!! $estadisticaPrecio->marca_descripcion !!}</td>
            <td>{!! $estadisticaPrecio->precio_venta !!}</td>
            <td>{!! $estadisticaPrecio->precio_anterior !!}</td>
            {{--<td>
                {!! Form::open(['route' => ['estadisticaPrecios.destroy', $estadisticaPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estadisticaPrecios.show', [$estadisticaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estadisticaPrecios.edit', [$estadisticaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>--}}
            
        </tr>
    @endforeach
    </tbody>
</table>
</div>
  {{ $estadisticaPrecios->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

