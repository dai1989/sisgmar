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
            <h3>Domicilio Proveedor
             
              <a href="{{route('domicilioProveedors.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('domicilio_proveedors.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
           <table class="table table-responsive" id="domicilioProveedors-table">
    <thead>
        <tr>
            
        <th>Proveedor</th>
        <th>Provincia Id</th>
        <th>Proveedor Id</th>
        <th>Calle</th>
        <th>Calle Numero</th>
        <th>Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($domicilioProveedors as $domicilioProveedor)
        <tr>
             <td>{!! $domicilioProveedor->razonsocial !!}</td>
            <td>{!! $domicilioProveedor->localidad_descripcion !!}</td>
            <td>{!! $domicilioProveedor->descripcion !!}</td>
           
            <td>{!! $domicilioProveedor->calle !!}</td>
            <td>{!! $domicilioProveedor->calle_numero !!}</td>
            <td>{!! $domicilioProveedor->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['domicilioProveedors.destroy', $domicilioProveedor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('domicilioProveedors.show', [$domicilioProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('domicilioProveedors.edit', [$domicilioProveedor->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
 {{$domicilioProveedors->render()}}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

