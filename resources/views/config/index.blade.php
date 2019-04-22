@extends('adminlte::layouts.app')
@section('content')
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Nombre de su Empresa: {{$config->nombre}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Lema: {{$config->lema}}</h4>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Cuit de la empresa: {{$config->cuit}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Teléfono: {{$config->telefono}}</h4>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Página Web: {{$config->campo2}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Direccion: {{$config->direccion}}</h4>
                      </div>
                    </div>
                   
      
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de la alerta mínima: {{$config->alert_minima}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de la alerta maxima: {{$config->alert_maxima}}</h4>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Díaz de los ultimos ingresos: {{$config->estadistica_diaz}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Cantidad de los productos vendidos: {{$config->pro_vendidos}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Cantidad de los productos con mayor recaudación: {{$config->pro_recaudacion}}</h4>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->menu_mini == '1')
                          <h4>Menu del negocio: Minimizado</h4>
                        @else
                          <h4>Menu del negocio: Maximizado</h4>
                        @endif
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Imagen del Sistema</h4>
                        <img src="{{asset('imagenes/config/'.$config->imagen)}}" height="100px" width="100px" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Articulo --}}
            <div class="tab-pane" id="producto">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Producto</h3> </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de paginas de productos: {{$config->producto_paginate}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->producto_orden == 'asc')
                          <h4>Forma: Desde el último agregado al primero</h4>
                        @else
                          <h4>Forma: Desde el primero agregado al último</h4>
                        @endif
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de paginas de categorías: {{$config->categoria_paginate}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->categoria_orden == 'asc')
                          <h4>Forma: Desde la última agregada a la primera</h4>
                        @else
                          <h4>Forma: Desde el primera agregada a la última</h4>
                        @endif
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de paginas de clientes: {{$config->cliente_paginate}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->cliente_orden == 'asc')
                          <h4>Forma: Desde el último agregado al primero</h4>
                        @else
                          <h4>Forma: Desde el primero agregado al último</h4>
                        @endif
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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de paginas de proveedores: {{$config->proveedores_paginate}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->proveedores_orden == 'asc')
                          <h4>Forma: Desde el último agregado al primero</h4>
                        @else
                          <h4>Forma: Desde el primero agregado al último</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- usuario --}}
            <div class="tab-pane" id="usuario">
              <div class="panel panel-info">
                <div class="panel-heading"> <h3 class="panel-title">Configuración de Usuarios</h3> </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <h4>Número de paginas de proveedores: {{$config->usuario_paginate}}</h4>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        @if ($config->usuario_orden == 'asc')
                          <h4>Forma: Desde el último agregado al primero</h4>
                        @else
                          <h4>Forma: Desde el primero agregado al último</h4>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           
            <a href="{{URL::action('ConfigController@edit', $config->id)}}"><button class="btn btn-primary">Editar</button></a>
            
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
