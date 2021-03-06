@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Categoria
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Editar Categoria
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($categoria, ['route' => ['categorias.update', $categoria->id], 'method' => 'patch']) !!}

                        @include('categorias.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection