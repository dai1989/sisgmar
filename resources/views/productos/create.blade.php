@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Crear Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Producto
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {{Form::open(array('url' => 'productos', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true'))}}
        {{Form::token()}}
          <div class="form-group col-sm-6">           
               <label for="barcode">Codigo de barras:</label>
               <input type="text" class="form-control" name="barcode" placeholder="codigo de barra..." required value="{{old('barcode')}}">            
            </div>
        <div class="form-group col-sm-6">           
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion..." required value="{{old('descripcion')}}">            
            </div>

                        <div class="form-group col-sm-6">           
               <label for="categoria_descripcion">Categoria:</label>
               <select name="categoria_id" id="" class="form-control">
                  @foreach($categorias as $cat)
                   <option value="{{$cat -> id}}">{{$cat -> categoria_descripcion}}</option>
                   @endforeach
               </select>
        </div>
        
         
             <div class="form-group col-sm-6">           
               <label for="descripcion">marca:</label>
               <select name="marca_id" id="" class="form-control">
                  @foreach($marcas as $m)
                   <option value="{{$m -> id}}">{{$m -> marca_descripcion}}</option>
                   @endforeach
               </select>
        </div>
         <div class="form-group col-sm-6">           
               <label for="precio_venta">Precio de venta:</label>
               <input type="text" class="form-control" name="precio_venta" placeholder="precio de venta..." required value="{{old('precio_venta')}}">            
            </div>
              <div class="form-group col-sm-6">           
               <label for="precio_compra">Precio de costo:</label>
               <input type="text" class="form-control" name="precio_compra" placeholder="precio de venta..." required value="{{old('precio_compra')}}">            
            </div>
        <div class="form-group col-sm-6">           
               <label for="stock">Stock</label>
              <input type="text" required value="{{old('stock')}}" name="stock" class="form-control" placeholder="Stock del artículo...">            
            </div>
             
            <div class="form-group col-sm-6">            
              <label for="imagen">Imagen</label>
              <input type="file" name="imagen" onchange="control(this)" accept="image/*" class="form-control">            
            </div>
        
        
          <div class="form-group col-sm-12">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productos.index') !!}" class="btn btn-danger">Cancelar</a>
  </div>
</div>                

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script> 
@endsection
@section('js')
  <script type="text/javascript">
  function control(f){
   var ext=['gif','jpg','jpeg','png'];
   var v=f.value.split('.').pop().toLowerCase();
   for(var i=0,n;n=ext[i];i++){
       if(n.toLowerCase()==v)
           return
   }
   var t=f.cloneNode(true);
   t.value='';
   f.parentNode.replaceChild(t,f);
   alert('Debe ser de tipo imagen');
   }
  </script>
@endsection