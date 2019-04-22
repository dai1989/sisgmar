<table class="table table-responsive" id="aumentoProductoPrecios-table">
    <thead>
        <tr>
           <th>Fecha Hora</th>
            <th>Producto</th>
        <th>Vendedor</th>
       
        <th>Aumento %</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($aumentoProductoPrecios as $aumentoProductoPrecio)
        <tr>
            <td>{!! $aumentoProductoPrecio->fecha_hora !!}</td>
            <td>{{$aumentoProductoPrecio->barcode}}-{!! $aumentoProductoPrecio->descripcion !!}</td>
            <td>{!! $aumentoProductoPrecio->name !!}</td>
            <td>{!! $aumentoProductoPrecio->aumento !!}</td>
            <td>
                 <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
                {{--{!! Form::open(['route' => ['aumentoProductoPrecios.destroy', $aumentoProductoPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('aumentoProductoPrecios.show', [$aumentoProductoPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('aumentoProductoPrecios.edit', [$aumentoProductoPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>