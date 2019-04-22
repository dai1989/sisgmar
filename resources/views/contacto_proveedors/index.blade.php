@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Contacto Proveedor
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
            <h3>Contacto Proveedor
             
              <a href="{{route('contactoProveedors.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('contacto_proveedors.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table table-responsive" id="contactoProveedors-table">
    <thead>
        <tr>
            <th>Proveedor</th>
        <th>Descripcion</th>
        <th>Tipo contacto</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contactoProveedors as $contactoProveedor)
        <tr>
            <td>{!! $contactoProveedor->razonsocial !!}</td>
            <td>{!! $contactoProveedor->contac_descripcion !!}</td>
            <td>{!! $contactoProveedor->contacto_descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['contactoProveedors.destroy', $contactoProveedor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contactoProveedors.show', [$contactoProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contactoProveedors.edit', [$contactoProveedor->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
 {{$contactoProveedors->render()}}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

