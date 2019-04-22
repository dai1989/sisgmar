<table class="table table-responsive" id="disminucionPrecios-table">
    <thead>
       <tr>
            <th>Cod.Producto</th>
           
            
        <th>Usuario</th>
        <th>Fecha Hora</th>
        <th>Disminucion %</th>
        <th colspan="3">Action</th> 
    
        </tr>
    </thead>
    <tbody>
    @foreach($disminucionPrecios as $disminucionPrecio)
        <tr>
             <td>{!! $disminucionPrecio->barcode !!}-{!! $disminucionPrecio->descripcion !!}
               
            </td>
            
           
            <td>{!! $disminucionPrecio->name !!}</td>
            <td>{!! $disminucionPrecio->fecha_hora !!}</td>
            <td>{!! $disminucionPrecio->disminucion !!}</td>
             <td>
               <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
            </td>
            {{--<td>
                {!! Form::open(['route' => ['disminucionPrecios.destroy', $disminucionPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('disminucionPrecios.show', [$disminucionPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('disminucionPrecios.edit', [$disminucionPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>--}}
        </tr>
    @endforeach
    </tbody>
</table>