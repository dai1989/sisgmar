<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Rols Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roles', $role->id, null) !!}
    <select name="roles[]" id="roles" class="form-control" multiple="multiple">
        <option value=""> -- Select One -- </option>
        @foreach($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12" style="padding: 0px; margin: 0px">
</div>

@if(!isset($create))
    <div class="form-group col-sm-12">
        <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Editar también contraseña
        </a>
    </div>
@endif


<div class="{{ !isset($create) ? "collapse" : '' }}" id="collapseExample">
    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password_confirmation', 'Confirmar password:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Imagen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('imagen', 'Imagen:') !!}
    <input id="files" name="imagen" type="file">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-danger">Cancelar</a>
</div>

@push('scripts')
<script>
    $(function () {
        $("#roles").select2();

        var $input = $("#files");
        $input.fileinput({
            {{--uploadUrl: "{{route('api.temp_files.multi_store',Auth::user()->id)}}", // server upload action--}}
//            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false, // hide remove button
//            minFileCount: 1,
//            maxFileCount: 5,
            allowedFileExtensions: ["png","bmp","gif","jpg","pdf"],
        });
    })
</script>
@endpush