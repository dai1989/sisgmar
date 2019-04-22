<table class="table table-responsive" id="pruebaPrecios-table">
    <thead>
        <tr>
            <th>Idproducto</th>
        <th>User Id</th>
        <th>Categoria Id</th>
        <th>Marca Id</th>
        <th>Fecha Hora</th>
        <th>Aumento</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pruebaPrecios as $pruebaPrecio)
        <tr>
            <td>{!! $pruebaPrecio->idproducto !!}</td>
            <td>{!! $pruebaPrecio->user_id !!}</td>
            <td>{!! $pruebaPrecio->categoria_id !!}</td>
            <td>{!! $pruebaPrecio->marca_id !!}</td>
            <td>{!! $pruebaPrecio->fecha_hora !!}</td>
            <td>{!! $pruebaPrecio->aumento !!}</td>
            <td>
                {!! Form::open(['route' => ['pruebaPrecios.destroy', $pruebaPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pruebaPrecios.show', [$pruebaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pruebaPrecios.edit', [$pruebaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>