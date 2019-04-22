@extends('layouts.app')
@section('content')

  <section class="content">
    <div class="box">
      <div class="box-header with-border table-responsive">
        <table class="table table-bordered" id="productos">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Código</th>
              <th>Categoría</th>
              <th>Marcas</th>
              <th>Stock</th>
              <th>Imagen</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($productos as $art)
              <tr>
                <td>{{$art->descripcion}}</td>
                <td>{{$art->barcode}}</td>
                <td>{{$art->categoria_descripcion}}</td>
                <td>{{$art->marca_descripcion}}</td>
                <td>{{$art->stock}}</td>
                <td>
                  <img src="{{asset('imagenes/productos/'.$art->imagen)}}" alt="{{$art->descripcion}}" height="100px" width="100px" class="img-thumbnail">
                </td>
                @if ($art->estado == 'Activo')
                  <td>Sin Borrar</td>
                @else
                  <td>Borrado</td>
                @endif

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
@section('js')
  <script type="text/javascript">
  $(document).ready(function(){
    $('#productos').DataTable();
  });
  </script>
@endsection
