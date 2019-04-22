<!-- Modal -->

<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" id="tamañomodal">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header ">
      <h4 class="modal-title" id="myModalLabel">
        
        Bienvenido al Sistema {{Auth::user()->name}}
      </h4>
      <p>A continuación configuremos el sistema "SGMAR", por favor recuerde colocar correctamente los datos de su empresa, si surge algún error puede configurarlo correctamente en el apartado "Configuración". Si surge algun inconveniente contacte con el Administrador del sistema.</p>
    </div>
    <div class="modal-body">
      {!! Form::open(array('url' => 'config/create', 'method'=>'POST', 'autocomplete' => 'off', 'files' => 'true')) !!}
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Nombre del Negocio</label>
              <input type="text" required name="nombre" placeholder="Nombre del negocio" title="Modelos posibles: A1, A3, A4 y A15" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Lema del Negocio</label>
              <input type="text" name="lema" placeholder="Lema del negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>CUIT del negocio</label>
              <input type="number" name="cuit" placeholder="cuit del negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Teléfono del Negocio</label>
              <input type="number" required name="telefono" placeholder="Teléfono del negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Email del Negocio</label>
              <input type="text" name="correo" placeholder="Correo del negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Página Web del Negocio</label>
              <input type="text" name="pagina" placeholder="Página web del negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Dirección del Negocio</label>
              <input type="text" required name="direccion" placeholder="Dirección del Negocio" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Impuesto de los productos</label>
              <input type="number" name="impuesto" placeholder="Impuesto sobre los productos" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Número de la alerta mínima</label>
              <input type="number" name="alert_minima" placeholder="Alerta mínima" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Número de la alerta máxima</label>
              <input type="number" required name="alert_maxima" placeholder="Alerta máxima" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Días de los últimos ingresos</label>
              <input type="number" required name="estadistica_diaz" placeholder="Días de los últimos ingresos" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Cantidad de los productos vendidos</label>
              <input type="number" required name="pro_vendidos" placeholder="Límite de los productos mas vendidos" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Cantidad de los productos con mayor recaudación</label>
              <input type="number" required name="pro_recaudacion" placeholder="Límite de los productos con mas recaudación" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Menú de Opciones</label>
              <select name="menu_mini" class="form-control">
                <option value="1">Minimizado</option>
                <option value="2">Maximizado</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label>Logo del negocio</label>
              <input type="file" name="imagen" onchange="control(this)" accept="image/*" class="form-control">
            </div>
          </div>
          <input type="hidden" name="idusuario" value="{{Auth::user()->id}}">
          <div class="modal-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar Configuración</button>
              </div>
            </div>
          </div>
    {!!Form::close()!!}
  </div>
</div>
</div>
