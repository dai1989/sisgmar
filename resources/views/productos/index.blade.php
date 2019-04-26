@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Productos
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
            <h3>Listado de Productos
             
              <a class="btn btn-success" href="{{route('productos.create')}}"><i class="fa fa-plus"></i>  <span class="hidden-xs hidden-sm">Agregar</span></a>
             
            </h3>
            @include('productos.search')
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
             <table class="table table-responsive" id="productos-table" id="barcode">
    <thead>
        <tr>
            <th>Cod.Producto</th>
        <th>Descripcion</th>
       
        <th>Stock</th>
        <th>Precio</th>
        <th>Marca</th>
        <th>Categoria</th>
        <th>Imagen</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $prod)
        <tr>
             <td>{!! $prod->barcode !!}
                @php
                echo DNS1D::getBarcodeHTML($prod->barcode,"C128");
                echo "<br>";
                @endphp
            </td>
            <td>{!! $prod->descripcion !!}</td>
           
            <td>{!! $prod->stock !!}</td>
            <td>${!! $prod->precio_venta !!}</td>
               <td>{!! $prod->marca !!}</td>
            <td>{!! $prod->categoria!!}</td>
             <td>
                <img src="{{asset('imagenes/productos/'.$prod -> imagen)}}" alt="{{$prod -> descripcion}}" height="100px" width="100px" class="img-thumbnail"></td>
            
            
           <td>@if($prod->estado == "Inactivo")
                        <span class="label label-danger">{{ $prod->estado}}</span>
                        @else
                        <span class="label label-success">{{ $prod->estado}}</span>
                        @endif
                      </td>
            <td>
                {!! Form::open(['route' => ['productos.destroy', $prod->idproducto], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   <a href="{{ url('productos/pdf/' . $prod->idproducto) }}"class="btn btn-success download btn-xs"> <i class="fa fa-download"></i></a>
                   <a href="{{ url('productos/listarPdf/' . $prod->idproducto) }}"class="btn btn-success download btn-xs"> <i class="fa fa-download"></i></a>
                    <a href="{!! route('productos.show', [$prod->idproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    <a href="{!! route('productos.edit', [$prod->idproducto]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="" data-target="#modal-delete-{{$prod->idproducto}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                </div>
                @include('productos.modal')
            </td>
        </tr>
         
    @endforeach
    </tbody>
</table>
                </div>
               {{ $productos->appends(request()->input())->links() }}
              </div>
            </div>
          </div>
        </div>
      </section>
         <div class="hidden">
    <canvas id="canvas"></canvas>
</div>


@endsection

