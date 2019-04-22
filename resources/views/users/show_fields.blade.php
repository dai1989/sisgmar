
<div class="form-group">
   

    <!-- Username Field -->
    {!! Form::label('username', 'Username:') !!}
    {!! $user->username !!}<br>

    <!-- Name Field -->
    {!! Form::label('name', 'Nombre:') !!}
    {!! $user->name !!}<br>

    <!-- Email Field -->
    {!! Form::label('email', 'Email:') !!}
    {!! $user->email !!}<br>

    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha de Alta:') !!}
    {!! $user->created_at !!}<br>

    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha de Modificacion:') !!}
    {!! $user->updated_at !!}<br>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

