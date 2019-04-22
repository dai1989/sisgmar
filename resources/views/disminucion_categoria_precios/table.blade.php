<table class="table table-responsive" id="disminucionCategoriaPrecios-table">
    <thead>
        <tr>
            <th>Fecha Hora</th>
             <th>Categoria</th>
        <th>Usuario</th>
       
        
        <th>Disminucion %</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($disminucionCategoriaPrecios as $disminucionCategoriaPrecio)
        <tr>
            <td>{!! $disminucionCategoriaPrecio->fecha_hora !!}</td>
            <td>{!! $disminucionCategoriaPrecio->categoria->categoria_descripcion !!}</td>
            <td>{!! $disminucionCategoriaPrecio->user->name !!}</td>
            
            <td>{!! $disminucionCategoriaPrecio->disminucion !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="/sisgmar/public/estadisticaPrecios" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                   
                </div> 
               {{--}} {!! Form::open(['route' => ['disminucionCategoriaPrecios.destroy', $disminucionCategoriaPrecio->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('disminucionCategoriaPrecios.show', [$disminucionCategoriaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('disminucionCategoriaPrecios.edit', [$disminucionCategoriaPrecio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>