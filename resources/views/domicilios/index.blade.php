@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Domicilios
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
            <h3>Domicilios
             
              <a href="{{route('domicilios.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('domicilios.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
           <table class="table table-responsive" id="domicilios-table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Documento</th>
        <th>Direccion</th>
        <th>N° de Casa</th>
        <th>Referencia</th>
        <th>Tipo de Domicilio</th>
        <th>Localidad</th>
        <th>Provincia</th>
        
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($domicilios as $domicilio)
        <tr>
            <td>{!! $domicilio->nombre !!},{{$domicilio->apellido}}</td>
            <td>{!! $domicilio->documento !!}</td>
            <td>{!! $domicilio->calle !!}</td>
            <td>{!! $domicilio->calle_numero !!}</td>
            <td>{!! $domicilio->descripcion !!}</td>
            <td>{!! $domicilio->tipo_descripcion !!}</td>
            <td>{!! $domicilio->localidad_descripcion!!}</td>
            <td>{!! $domicilio->descripcion !!}</td>
           
            <td>
                {!! Form::open(['route' => ['domicilios.destroy', $domicilio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('domicilios.show', [$domicilio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('domicilios.edit', [$domicilio->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
 {{$domicilios->render()}}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

