<table class="table table-responsive" id="roles-table">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Slug</th>
        <th>Descripcion</th>
        <th>Special</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{!! $role->name !!}</td>
            <td>{!! $role->slug !!}</td>
            <td>{!! $role->description !!}</td>
            <td>{!! $role->special !!}</td>
            <td>
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('roles.show', [$role->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                   <a href="" data-target="#modal-delete-{{$role->id}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                </div>
                
            </td>
        </tr>
         @include('roles.modal')
    @endforeach
    </tbody>
</table>