@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Contactos
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
            <h3>Contactos
             
              <a href="{{route('contactos.create')}}"><button class="btn btn-success">Nuevo</button></a>
             
            </h3>
            @include('contactos.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table table-responsive" id="contactos-table">
    <thead>
        <tr>
            <th>Cliente</th>
        <th>Documento</th>
        <th>Descripcion</th>
        <th>Tipo contacto</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contactos as $contacto)
        <tr>
            
            <td>{!! $contacto->nombre!!},{{$contacto->apellido}}</td>
             <td>{!! $contacto->documento !!}</td>
            <td>{!! $contacto->contacto_descripcion !!}</td>
              <td>{!! $contacto->contac_descripcion !!}</td>
            
            <td>
                {!! Form::open(['route' => ['contactos.destroy', $contacto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contactos.show', [$contacto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contactos.edit', [$contacto->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
 {{$contactos->render()}}
</div>
</div>
          </div>
        </div>
      </section>
       
@endsection

