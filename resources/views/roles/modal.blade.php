<div class="modal modal-warning" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$role->id}}">

    {{ Form::Open(array('action'=>array('RoleController@destroy', $role->id), 'method' => 'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden='true'>x</span>
                </button>
                <h4 class="modal-title" >Eliminar rol</h4>
            </div>
            <div class="modal-body">
                <p>Confirme si desea Eliminar el rol selaccionado</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">SI</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}

</div>
