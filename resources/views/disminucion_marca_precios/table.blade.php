<table class="table table-responsive" id="disminucionMarcaPrecios-table">
    <thead>
        <tr>
           
        <th>Fecha Hora</th>
        <th>Marcas</th>
        <th>Fecha Hora</th>
        <th>Disminucion %</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($disminucionMarcaPrecios as $disminucionMarcaPrecio)
        <tr>
            <td>{!! $disminucionMarcaPrecio->fecha_hora !!}</td>
            <td>{!! $disminucionMarcaPrecio->user->name !!}</td>
            <td>{!! $disminucionMarcaPrecio->marca->marca_descripcion !!}</td>
            
            <td>{!! $disminucionMarcaPrecio->disminucion !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
               {{--}} {!! Form::open(['route' => ['disminucionMarcaPrecios.destroy', $disminucionMarcaPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('disminucionMarcaPrecios.show', [$disminucionMarcaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('disminucionMarcaPrecios.edit', [$disminucionMarcaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>