@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear compra
@endsection

@section('content')
<style>
  .rect-checkbox{float:left;margin-left:130px;}
  .span {margin-left: -180px;}
</style>
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Ingreso</h3>
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
        {!! Form::open(array('url' => 'ingreso', 'method'=>'POST', 'autocomplete' => 'off'))!!}
        {{Form::token()}}
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select autofocus name="proveedor_id" class="form-control selectpicker" id="proveedor_id" data-live-search="true">
                  <option></option>
                  @foreach($proveedores as $proveedor)
                    <option value="{{$proveedor->id}}">{{$proveedor->razonsocial}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div id="rect-checkbox">
              <span class="span">Nuevo Proveedor:  &nbsp;&nbsp;</span>
              <input class="rect-nicelabel" name="check" id="check" value="1" onchange="javascript:showContent()" data-nicelabel='{"position_class": "rect-checkbox"}'  type="checkbox" />
            </div>
            <div  id="content" style="display: none;">
              @include('layouts.proveedornuevo')
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="serie_comprobante">Serie del comprobante:</label>
                <input type="text" class="form-control" name="serie_comprobante" placeholder="Serie del comprobante..."  value="{{old('serie_comprobante')}}">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="num_comprobante">N° comprobante:</label>
                <input type="text" class="form-control" name="num_comprobante" placeholder="Numero del comprobante..."  required value="{{old('num_comprobante')}}">
            </div>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="tipofactura_id">Tipo factura</label>
              <select  type="text" name="tipofactura_id" class="form-control" id="tipofactura_id" placeholder="tipo de factura" >
                <option value="">--Seleccionar--</option>
                @foreach ($tipofactura_list as $tipofactura)
                <option value="{{ $tipofactura->id }}">{{ $tipofactura->descripcion }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
             <label for="tipopago_id">Tipo de Pago</label>
                <select  type="text" name="tipopago_id" class="form-control" id="tipopago_id" placeholder="tipo de factura" >
                  <option value="">--Seleccionar--</option>
                  @foreach ($tipopago_list as $tipopago)
                  <option value="{{ $tipopago->id }}">{{ $tipopago->descripcionpago }}</option>
                  @endforeach
                </select>
            </div>
          </div>
        </div>
        <div class="">
          <div class="panel panel-primary">
            <div class="panel-body">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label>Producto</label>
                  <select autofocus  name="pidproducto" class="form-control selectpicker" id="pidproducto" data-live-search="true">
                    <option value="0"></option>
                    @foreach($productos as $producto)
                      <option value="{{$producto->idproducto}}_{{$producto->precio_venta}}">{{$producto->producto}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="form-group">
                  <label for="cantidad">Cantidad</label>
                  <input type="number" step="0.01" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="form-group">
                  <label for="precio_compra">Precio Compra</label>
                  <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Precio Compra">
                </div>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <label for="precio_venta">Precio Venta</label>
                                <input type="number" step=".01" name="pprecio_venta" id="pprecio_venta" class="form-control">
                            </div>
                        </div>
             
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class="form-group">
                  <button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                <table id="detalles" class="table">
                  <thead style="background-color: #A9D0F5" >
                    <th>Opciones</th>
                    <th>Productos</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                   
                    <th>Subtotal</th>
                  </thead>
                  <tfoot>
                    <th>TOTAL</th>
                    
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><h4 id="total">$ 0.00</h4></th>
                  </tfoot>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
            <div class="form-group">
              <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    </div>
  </section>
  @section('js')
    <script>

    function showContent() {
      element = document.getElementById("content");
      check = document.getElementById("check");
      if (check.checked) {
        element.style.display='block';
      }
      else {
        element.style.display='none';
      }
    }
    $(function(){
      $('#rect-checkbox > input').nicelabel();
      $('#text-checkbox-ico > input:eq(0)').nicelabel({
        checked_ico: './checked.png',
        unchecked_ico: './unchecked.png'
      });

    });
    </script>
  @endsection
  @push('scripts')
    <script>
    $(document).ready(function(){
      $('#bt-add').click(function(){
        agregar();
      });
    });
    var cont=0;
    total=0;
    subtotal=[];
    total=0;
    $("#guardar").hide();
    $("#pidproducto").change(mostrarValores);

    function mostrarValores(){
        datosProducto=document.getElementById('pidproducto').value.split('_');
        $("#pprecio_venta").val(datosProducto[1]);
        
    }
    function agregar(){
      var idproducto=datosProducto[0];
     var producto=$("#pidproducto option:selected").text();
      var precio_venta= parseFloat($("#pprecio_venta").val());
      cantidad=$("#pcantidad").val();
      precio_compra=$("#pprecio_compra").val();
      
      


      if (idproducto!="" && cantidad!="" && cantidad>0 && pprecio_compra!="" && precio_venta!="" )
      {
        subtotal[cont]=(cantidad*precio_compra);
        total=total+subtotal[cont];
        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-xs" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input readonly type="number" name="cantidad[]" value="'+cantidad+'"></td> <td><input readonly type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input readonly type="number" name="precio_venta[]" value="'+precio_venta+'"></td>  <td>'+subtotal[cont]+'</td></tr>';
        cont++;
        limpiar();
        $('#total').html("$ " + total);
        evaluar();
        $('#detalles').append(fila);

      }
      else
      {
        alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
      }
    }
    function limpiar(){
      $('#pcantidad').val("");
      $('#pstock').val("");
      $('#pdescuento').val("");
     
      $('#pprecio_compra').val("");
      $('#pprecio_venta').val("");
      $('#pidproducto').selectpicker('val', '0');
    }
    function evaluar()
    {
      if (total>0)
      {
        $("#guardar").show();
      }
      else
      {
        $("#guardar").hide();
      }
    }
    function eliminar(index){
      total=total-subtotal[index];
      $("#total").html("$ " + total);
      $("#fila" + index).remove();
      evaluar();
    }
    </script>
  @endpush
@endsection

