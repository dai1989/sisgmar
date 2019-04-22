@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Disminucion Por Marca
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
            <h3>Disminucion de precio por marca
             
              <a href="{{route('disminucionMarcaPrecios.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('disminucion_marca_precios.search')
           
           
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
           <table class="table table-responsive" id="disminucionMarcaPrecios-table">
    <thead>
        <tr>
           
        <th>Fecha Hora</th>
        <th>Marcas</th>
        <th>Fecha Hora</th>
        <th>Disminucion $</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($disminucionMarcaPrecios as $disminucionMarcaPrecio)
        <tr>
            <td>{!! $disminucionMarcaPrecio->fecha_hora !!}</td>
            <td>{!! $disminucionMarcaPrecio->name !!}</td>
            <td>{!! $disminucionMarcaPrecio->marca_descripcion !!}</td>
            
            <td>{!! $disminucionMarcaPrecio->disminucion !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
               {{--}} {!! Form::open(['route' => ['disminucionMarcaPrecios.destroy', $disminucionMarcaPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('disminucionMarcaPrecios.show', [$disminucionMarcaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('disminucionMarcaPrecios.edit', [$disminucionMarcaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
  {{ $disminucionMarcaPrecios->appends(request()->input())->links() }}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

