@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')
@section('htmlheader_title')
    Ventas
@endsection

@section('content')
<style>
    .rect-checkbox{float:left;margin-left:130px;}
    .span {margin-left: -161px;}
</style>

<section class="content">
   <div class="box box-primary">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Nueva Venta</h3>
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
            {!! Form::open(array('url' => 'venta', 'method'=>'POST', 'autocomplete' => 'off'))!!}
            {{Form::token()}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <select name="persona_id" class="form-control selectpicker" id="persona_id" data-live-search="true">
                                <option></option>
                                @foreach($personas as $persona)
                                    <option value="{{$persona->id}}">{{$persona->nombre}},{{$persona->apellido}}--{{$persona->condicion_iva}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="rect-checkbox">
                        <span class="span">Nuevo Cliente:  &nbsp;&nbsp;</span>
                        <input class="rect-nicelabel" name="check" id="check" value="1" onchange="javascript:showContent()" data-nicelabel='{"position_class": "rect-checkbox"}'  type="checkbox" />
                    </div>
                    <div  id="content" style="display: none;">
                        @include('layouts.clientenuevo')
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <select  type="text" name="tipopago_id" class="form-control" multiple="multiple"id="tipopago_id" placeholder="tipo de factura" >
                  <option value="">--Seleccionar--</option>
                  @foreach ($tipopago_list as $tipopago)
                  <option value="{{ $tipopago->id }}">{{ $tipopago->descripcionpago }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-sm-12" style="padding: 0px; margin: 0px">
</div>

@if(!isset($create))
    <div class="form-group col-sm-12">
        <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Pago con nota de credito
        </a>
    </div>
@endif


<div class="{{ !isset($create) ? "collapse" : '' }}" id="collapseExample">
    <!-- Password Field -->
    <div class="form-group col-sm-6">
        <label for="iddevolucion">Nota de credito N°</label>
                <select  type="text" name="iddevolucion" class="form-control" id="iddevolucion" placeholder="tipo de factura" >
                  <option value="">--Seleccionar--</option>
                  @foreach ($devoluciones as $devolucion)
                  <option value="{{ $devolucion->iddevolucion }}">{{ $devolucion->num_comprobante }}</option>
                  @endforeach
                </select>
            </div>
        </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="num_comprobante">N° comprobante:</label>
                <input type="text" class="form-control" name="num_comprobante" placeholder="Numero del comprobante..."  required value="{{old('num_comprobante')}}">
            </div>
          </div>
                </div>
            </div>
            <div class="">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Producto</label>
                                <select name="pidproducto" class="form-control selectpicker" id="pidproducto" data-live-search="true">
                                    <option value="0"></option>
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->idproducto}}_{{$producto->stock}}_{{$producto->precio_venta}}">{{$producto->producto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" step=".01" name="pcantidad" id="pcantidad" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" step=".01" disabled name="pstock" id="pstock" class="form-control" >
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
                                <label for="descuento">Descuento</label>
                                <input type="number" step=".01" name="pdescuento" id="pdescuento" class="form-control" placeholder="descuento..">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <button type="button" id="bt-add" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody id="detalles">
                                </tbody>
                                <tbody>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                </tbody>
                                <tbody>
                                    <th>Efectivo</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> <input type="number" class="form-control" value="0" placeholder="efectivo" min="0"  name="entrega"></th>
                                </tdbody>
                                 <tbody>
                                    <th>Tarjeta</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><input type="number" class="form-control" value="0" placeholder="Tarjeta de Credito" min="0"  name="pago_tarjeta"></th>
                                    <tbody>
                                    <th>Debito</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><input type="number" class="form-control" value="0" placeholder="Tarjeta de Debito" min="0"  name="debito"></th>
                                </tdbody>
                                </tdbody>
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
            <input type="hidden" name="idusuario" value="{{Auth::user()->id}}">
            {!!Form::close()!!}
        </div>
    </div>
</section>
@push('scripts')
<script>
    $(function () {
        $("#tipopago_id").select2();

        var $input = $("#files");
        $input.fileinput({
            {{--uploadUrl: "{{route('api.temp_files.multi_store',Auth::user()->id)}}", // server upload action--}}
//            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false, // hide remove button
//            minFileCount: 1,
//            maxFileCount: 5,
            allowedFileExtensions: ["png","bmp","gif","jpg","pdf"],
        });
    })
</script>
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
        $("#pprecio_venta").val(datosProducto[2]);
        $("#pstock").val(datosProducto[1]);
    }

    function agregar(){

        var idproducto=datosProducto[0];
        var producto=$("#pidproducto option:selected").text();
        var cantidad=$("#pcantidad").val();
        var descuento=$("#pdescuento").val();
        var precio_venta= parseFloat($("#pprecio_venta").val());
        var stock=$("#pstock").val();
        var stock_numero = parseInt(stock);
        var stock_cantidad = parseInt(cantidad);

        if (idproducto!="" && cantidad!="" && cantidad>0 && pdescuento!="" && precio_venta!="")
        {
            if (stock_numero>=stock_cantidad)
            {
                subtotal[cont]=(cantidad*precio_venta-descuento);
                total=total+subtotal[cont];
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-xs" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idproducto[]" value="'+idproducto+'">'+producto+'</td><td><input readonly type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input readonly type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td><input readonly type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
                cont++;
                limpiar();
                $('#total').html("$ " + total);
                $('#total_venta').val(total);
                evaluar();
                $('#detalles').append(fila);
            }
            else
            {
                alert('La cantidad a vender supera el stock');
            }

        }
        else
        {
            alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
        }
    }

    function limpiar(){
        $('#pcantidad').val("");
        $('#pstock').val("");
        $('#pdescuento').val("");
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
        $('#total_venta').val(total);
        $("#fila" + index).remove();
        evaluar();
    }
    </script>
@endpush
@endsection
