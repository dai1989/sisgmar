<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="razonsocial">Proveedor</label>
      <input type="text" value="{{old('razonsocial')}}" name="razonsocial" class="form-control" placeholder="Proveedor...">
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="cuit">Cuit</label>
      <input type="text" value="{{old('cuit')}}" name="cuit" class="form-control" placeholder="Cuit...">
    </div>
  </div>
  <div class="form-group col-sm-6">
  <label for="condicion_iva">Condicion frente al IVA</label>
  <select class="form-control" name="condicion_iva" id="condicion_iva" class="form-control">
    <option value="">--Seleccionar--</option><br>
    <option value="Responsable Inscripto">Responsable Inscripto</option>
    <option value="Consumidor Final">Consumidor Final</option></select><br>
                        </div>
</div>
