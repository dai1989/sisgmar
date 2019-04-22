<div class="modal fade" id="abrir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Abrir Arqueo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'arqueo.store', 'method'=>'POST', 'autocomplete' => 'off', 'files' => 'true','id'=>'form_ag' , 'enctype'=>'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="">Cantidad de dinero en Caja</label>
                        <input required type="number" name="cantidad" class="form-control">
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" form="form_ag" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>