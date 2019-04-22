<table class="table table-responsive" id="contactoProveedors-table">
    <thead>
        <tr>
            <th>Proveedor</th>
        <th>Descripcion</th>
        <th>Tipo contacto</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contactoProveedors as $contactoProveedor)
        <tr>
            <td>{!! $contactoProveedor->razonsocial !!}</td>
            <td>{!! $contactoProveedor->contac_descripcion !!}</td>
            <td>{!! $contactoProveedor->contacto_descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['contactoProveedors.destroy', $contactoProveedor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contactoProveedors.show', [$contactoProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contactoProveedors.edit', [$contactoProveedor->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>