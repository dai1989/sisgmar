@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Editar Producto
@endsection

@section('content')
   <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Producto: {{$producto->nombre}} </h3>
            @if (count($errors)>0)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
        </div>
        {!!Form::model($producto,['route'=>['productos.update', $producto->idproducto] , 'method'=>'PATCH', 'files'=>'true'] )!!}
        {{Form::token()}}
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="descripcion">Nombre</label>
              <input type="text" required value="{{$producto->descripcion}}" name="descripcion" class="form-control">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Categoría</label>
              <select name="categoria_id" class="form-control">
                @foreach ($categorias as $cat)
                  @if($cat->categoria_id==$producto->categoria_id)
                    <option value="{{$cat->id}}" selected > {{$cat->categoria_descripcion}}</option>
                  @else
                    <option value="{{$cat->id}}"> {{$cat->categoria_descripcion}}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label>Marca</label>
              <select name="marca_id" class="form-control">
                @foreach ($marcas as $marca)
                  @if($marca->marca_id==$producto->marca_id)
                    <option value="{{$marca->id}}" selected > {{$marca->marca_descripcion}}</option>
                  @else
                    <option value="{{$marca->id}}"> {{$marca->marca_descripcion}}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="barcode">Codígo</label>
              <input type="text" required value="{{$producto->barcode}}" name="barcode" class="form-control">
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="text" required  value="{{$producto->stock}}" name="stock" class="form-control">
            </div>
          </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="precio_venta">Precio de venta</label>
              <input type="text" required value="{{$producto->precio_venta}}" name="precio_venta" class="form-control">
            </div>
          </div>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="precio_compra">Precio de compra</label>
              <input type="text" required value="{{$producto->precio_compra}}" name="precio_compra" class="form-control">
            </div>
          </div>
           
         
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" class="form-control">
              @if(($producto->imagen)!="")
                <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" class="img-thumbnail">
              @endif
            </div>
          </div>
          <div class="form-group col-sm-12">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productos.index') !!}" class="btn btn-danger">Cancelar</a>
  </div>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </section>
@endsection