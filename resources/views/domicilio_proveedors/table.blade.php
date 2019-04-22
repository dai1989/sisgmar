<table class="table table-responsive" id="domicilioProveedors-table">
    <thead>
        <tr>
            
        <th>Proveedor</th>
        <th>Provincia Id</th>
        <th>Proveedor Id</th>
        <th>Calle</th>
        <th>Calle Numero</th>
        <th>Descripcion</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($domicilioProveedors as $domicilioProveedor)
        <tr>
             <td>{!! $domicilioProveedor->razonsocial !!}</td>
            <td>{!! $domicilioProveedor->localidad_descripcion !!}</td>
            <td>{!! $domicilioProveedor->descripcion !!}</td>
           
            <td>{!! $domicilioProveedor->calle !!}</td>
            <td>{!! $domicilioProveedor->calle_numero !!}</td>
            <td>{!! $domicilioProveedor->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['domicilioProveedors.destroy', $domicilioProveedor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('domicilioProveedors.show', [$domicilioProveedor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('domicilioProveedors.edit', [$domicilioProveedor->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>