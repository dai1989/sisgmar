@extends('adminlte::layouts.app')
@section('content')
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        {!!Form::model($configuracion,['route'=>['configuracion.update', $config->id] , 'method'=>'PATCH', 'files'=>'true'] )!!}
        {{Form::token()}}
        <div class="container">
          <h3 class="text-center">Configuración Del Sistema</h3>
        </div>
        <div class="container-fluit">
            @include('flash::message')
        </div>
        <div class="nav-tabs-custom">
         
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración Basica</h3> </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Nombre del Negocio</label>
                        <input type="text" required value="{{$config->nombre}}" name="nombre" placeholder="Nombre del negocio" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Lema del Negocio</label>
                        <input type="text" value="{{$config->lema}}" name="lema" placeholder="Lema del negocio" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>CUIT del Negocio</label>
                        <input type="text" value="{{$config->cuit}}" name="cuit" placeholder="CUIT del negocio" class="form-control">
                      </div>
                    </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Condicion frente al IVA</label>
                        <input type="text" value="{{$config->condicion_iva}}" name="condicion_iva" placeholder="condicion frente al iva" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Teléfono del Negocio</label>
                        <input type="text" required value="{{$config->telefono}}" name="telefono" placeholder="Teléfono del negocio" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Email del Negocio</label>
                        <input type="text" value="{{$config->correo}}" name="correo" placeholder="Email del negocio" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Página del Negocio</label>
                        <input type="text" value="{{$config->campo2}}" name="pagina" placeholder="Página web del negocio" class="form-control">
                      </div>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Dirección del Negocio</label>
                        <input type="text" value="{{$config->direccion}}"required name="direccion" placeholder="Dirección del Negocio" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Impuesto de los productos</label>
                        <input type="text" value="{{$config->impuesto}}" name="impuesto" placeholder="Impuesto sobre los productos" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Número de la alerta mínima</label>
                        <input type="number" required value="{{$config->alert_minima}}" name="alert_minima" placeholder="Alerta mínima" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Número de la alerta maxima</label>
                        <input type="number" required value="{{$config->alert_maxima}}" name="alert_maxima" placeholder="Alerta maxima" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Díaz de los ultimos ingresos</label>
                        <input type="number" required value="{{$config->estadistica_diaz}}" name="estadistica_diaz" placeholder="Díaz de los ultimos ingresos" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Cantidad de los productos vendidos</label>
                        <input type="number" required value="{{$config->pro_vendidos}}" name="pro_vendidos" placeholder="Límite de los productos mas vendidos" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Cantidad de los productos con mayor recaudación</label>
                        <input type="number" required value="{{$config->pro_recaudacion}}" name="pro_recaudacion" placeholder="Límite de los productos con mas recaudación" class="form-control">
                      </div>
                    </div>
                   
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Logo del negocio</label>
                        <input type="file" name="imagen" class="form-control">
                        @if(($config->imagen)!="")
                          <img src="{{asset('imagenes/config/'.$config->imagen)}}" height="100px" width="100px" class="img-thumbnail">
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Producto --}}
            <div class="tab-pane" id="producto">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Producto</h3> </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Número de paginas de artículos:</label>
                        <input type="number" required value="{{$config->producto_paginate}}" name="producto_paginate" placeholder="Página de Artículos" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="form-group">
                        <label>Forma de ordanmiento</label>
                        <select name="producto_orden" class="form-control">
                          @if ($config->producto_orden == 'asc')
                            <option selected value="asc">Desde el último agregado al primero</option>
                            <option value="desc">Desde el primero agregado al último</option>
                          @else
                            <option value="asc">Forma: Desde el último agregado al primero</option>
                            <option selected value="desc">Desde el primero agregado al último</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- categoria --}}
            <div class="tab-pane" id="categoria">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Categorías</h3> </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Número de paginas de categorías:</label>
                          <input type="number" required value="{{$config->categoria_paginate}}" name="categoria_paginate" placeholder="Página de Categorías" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Forma de ordanmiento</label>
                          <select name="categoria_orden" class="form-control">
                            @if ($config->categoria_orden == 'asc')
                              <option selected value="asc">Desde la última agregada a la primera</option>
                              <option value="desc">Desde la primera agregada a la última</option>
                            @else
                              <option  value="asc">Desde la última agregada a la primera</option>
                              <option selected value="desc">Desde la primera agregada a la última</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            {{-- cliente --}}
            <div class="tab-pane" id="cliente">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Cliente</h3> </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Número de paginas de Cliente:</label>
                          <input type="number" required value="{{$config->cliente_paginate}}" name="cliente_paginate" placeholder="Página de Clientes" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Forma de ordanmiento</label>
                          <select name="cliente_orden" class="form-control">
                            @if ($config->cliente_orden == 'asc')
                              <option selected value="asc">Desde el último agregado al primero</option>
                              <option value="desc">Desde el primero agregado al último</option>
                            @else
                              <option value="asc">Forma: Desde el último agregado al primero</option>
                              <option selected value="desc">Desde el primero agregado al último</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- proveedores --}}
            <div class="tab-pane" id="proveedores">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Proveedores</h3> </div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Número de paginas de Proveedor:</label>
                          <input type="number" required value="{{$config->proveedores_paginate}}" name="proveedores_paginate" placeholder="Página de Proveedor" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Forma de ordanmiento</label>
                          <select name="proveedores_orden" class="form-control">
                            @if ($config->proveedores_orden == 'asc')
                              <option selected value="asc">Desde el último agregado al primero</option>
                              <option value="desc">Desde el primero agregado al último</option>
                            @else
                              <option value="asc">Forma: Desde el último agregado al primero</option>
                              <option selected value="desc">Desde el primero agregado al último</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- usuario --}}
            <div class="tab-pane" id="usuario">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Usuarios</h3></div>
                <div class="panel-body">
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Número de paginas de Usuarios:</label>
                          <input type="number" required value="{{$config->usuario_paginate}}" name="usuario_paginate" placeholder="Página de Usuarios" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                          <label>Forma de ordanmiento</label>
                          <select name="usuario_orden" class="form-control">
                            @if ($config->usuario_orden == 'asc')
                              <option selected value="asc">Desde el último agregado al primero</option>
                              <option value="desc">Desde el primero agregado al último</option>
                            @else
                              <option value="asc">Forma: Desde el último agregado al primero</option>
                              <option selected value="desc">Desde el primero agregado al último</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="/sisgmar/public/config" class="btn btn-danger">Cancelar</a>
</div>
       
        {!!Form::close()!!}
      </div>
    </div>
  </section>
@endsection
