

        <h3>Ficha de Stock</h3>
        <div class="panel-body">
          <div class="tab-pane">
            <div class="panel panel-info">
              <div class="panel-heading"> <h3 class="panel-title">{{$producto->descripcion}}</h3> </div>
              
              <div class="panel-body table-responsive">
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                      <h5>Stock Disponible: {{$producto->stock}}</h5>
                    </div>
                    
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                      <h5>Código del Producto: {!! $producto->barcode !!}
                @php
                echo DNS1D::getBarcodeHTML($producto->barcode,"C128");
                echo "<br>";
                @endphp</h5>
                      
                    </div>
                     <div class="form-group">
                      <h5>Precio de costo inicial: ${{$producto->precio_compra}}</h5>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="form-group">
                      <h5>Imagen del Producto:</h5>  <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" alt="{{$producto->descripcion}}" height="100px" width="100px" class="img-thumbnail">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div style="background-color: rgba(255, 255, 255, 0);" class="panel panel-info table-responsive">
            <table style="background-color: rgb(217, 237, 247);" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Cantidad</th>
                  <th>Tipo</th>
                  <th>Precio Venta</th>
                  <th>Precio Compra</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($todo2 as $prod)
                  <tr>
                    <th>{{date("d-m-Y", strtotime($prod->created_at))}}</th>
                    <th class="text-derecha">{{number_format($prod->cantidad, 2, '.', '')}}</th>
                    @isset($prod->iddetalle_ingreso)
                      <th scope="row"><span class="label label-info">Ingreso</span></th>
                    @else
                      @isset($prod->iddetalle_venta)
                        <th  scope="row"><span class="label label-success">Venta</span></th>
                      @else
                        <th scope="row"><span class="label label-danger">Venta Mensual</span></th>
                      @endisset
                    @endisset
                    <th class="text-derecha">{{$prod->precio_venta}} $</th>
                    @isset($prod->precio_compra)
                      <th class="text-derecha">{{$prod->precio_compra}} $</th>
                    @else
                      <th class="text-derecha"></th>
                    @endisset
                    @isset($prod->iddetalle_ingreso)
                      <th class="text-derecha">{{$prod->precio_compra*$prod->cantidad}} $ <small class="label pull-right bg-red">Salida</small></th>
                      @else
                      <th class="text-derecha">{{$prod->precio_venta*$prod->cantidad}} $ <small class="label pull-right bg-green">Entrada</small></th>
                    @endisset
                  </tr>
                @endforeach
              </tbody>
            </table>
             
            </table>
          </div>
        </div>
   

