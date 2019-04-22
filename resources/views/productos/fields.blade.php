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
        
        <div class="form-group">
          <unique-barcode-input>
                        </unique-barcode-input>
                      </div>
                      
        
            <div class="form-group col-sm-6">           
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock" placeholder="Stock..." required value="{{old('stock')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">           
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta" placeholder="Precio venta..." required value="{{old('precio_venta')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">           
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion..." required value="{{old('descripcion')}}">            
            </div>
        
        
             <div class="form-group col-sm-6">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
            </div>
        
        

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productos.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
