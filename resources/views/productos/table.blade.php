<table class="table table-responsive" id="productos-table" id="barcode">
    <thead>
        <tr>
            <th>Cod.Producto</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Stock</th>
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
                echo DNS1D::getBarcodeHTML($prod->barcode,"EAN13");
                echo "<br>";
                @endphp
            </td>
            <td>{!! $prod->descripcion !!}</td>
            <td>{!! $prod->precio_venta !!}</td>
            <td>{!! $prod->stock !!}</td>
               <td>{!! $prod->marca !!}</td>
            <td>{!! $prod->categoria!!}</td>
             <td>
                <img src="{{asset('imagenes/productos/'.$prod -> imagen)}}" alt="{{$prod -> descripcion}}" height="100px" width="100px" class="img-thumbnail"></td>
            
            <td>{!! $prod->estado !!}</td>
           
            <td>
                {!! Form::open(['route' => ['productos.destroy', $prod->idproducto], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productos.show', [$prod->idproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('productos.edit', [$prod->idproducto]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
         
    @endforeach
    </tbody>
</table>