<table class="table table-responsive" id="contactos-table">
    <thead>
        <tr>
            <th>Cliente</th>
        <th>Documento</th>
        <th>Descripcion</th>
        <th>Tipo contacto</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contactos as $contacto)
        <tr>
            
            <td>{!! $contacto->nombre!!},{{$contacto->apellido}}</td>
             <td>{!! $contacto->documento !!}</td>
            <td>{!! $contacto->contacto_descripcion !!}</td>
              <td>{!! $contacto->contac_descripcion !!}</td>
            
            <td>
                {!! Form::open(['route' => ['contactos.destroy', $contacto->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contactos.show', [$contacto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contactos.edit', [$contacto->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>