@extends('adminlte::layouts.app')
@section('content')
@section('css')
    @include('layouts.datatables1_css')
@endsection
  <section class="content">
    <div class="box">
      <div class="box-header with-border table-responsive">
        <table class="table table-bordered" id="productos">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Producto</th>
              <th>Procio de Venta</th>
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
                <td>{{$art->barcode}}</td>
                <td>{{$art->descripcion}}</td>
                <td>{{$art->precio_venta}}</td>
                <td>{{$art->categoria}}</td>
                <td>{{$art->marca}}</td>
                <td>{{$art->stock}}</td>
                <td>
                  <img src="{{asset('imagenes/productos/'.$art->imagen)}}" alt="{{$art->descripcion}}" height="100px" width="100px" class="img-thumbnail">
                </td>
                @if ($art->estado == 'Activo')
                  <td>Activo</td>
                @else
                  <td>Inactivo</td>
                @endif

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
 @include('layouts.datatables1_js')

  <script type="text/javascript">
 $(document).ready(function() {
    $('#productos').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );
  </script>
@endsection
