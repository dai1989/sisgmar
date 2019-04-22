@section('css')
    @include('layouts.datatables_css')
@endsection

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
            <td>{!! $estadisticaPrecio->created_at !!}</td>
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
 
  @section('js')
  @include('layouts.datatables_js')
  <script type="text/javascript">
  $(document).ready(function() {
    $('#estadisticaPrecios-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            
        ]
    } );
} );
  </script>
@endsection