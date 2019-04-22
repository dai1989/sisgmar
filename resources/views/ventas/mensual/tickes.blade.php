@extends('layouts.app')
@section('content')
<style type="text/css" media="print">
#Imprime {
 height: auto;
 width: 310px;
 margin: 0px;
 padding: 0px;
 float: left;
 font-family: Arial, Helvetica, sans-serif;
 font-size: 7px;
 font-style: normal;
 line-height: normal;
 font-weight: normal;
 font-variant: normal;
 text-transform: none;
}
@page{
   margin: 0;
}
</style>
<style type="text/css" media="screen">
    .left{
    float: left;
    background:blue;
}
.right{
    float: right;
    background:red;
}
.center{
    background:green;
  }
</style>

  <div class="page-content">
    <div class="row">
     <div class="col-lg-10">
      <div class="portlet box portlet-pink">
        <div class="portlet-header" style="background-color: #f5f5f5;">
          <div class="caption box-heading" style="color: #777;"><img src="{{ asset('imagenes/config/impresora.png') }}" alt="Product Image" class="img-rounded" width="60">  </div>
          <div class="actions">

          </div>
          </div>
  <div class="portlet-body">
      <p>
  <div class="row">
    <div class="col-md-6">
  <div class="form-group">

  <div class="panel panel-default">
      <div class="panel-heading box-heading" style="color:#0a819c;" align="center">Total Pago</div>
      <div class="panel-body"><h4 class="box-heading" align="center" style="color:#5cb85c;">S/. 185</h4></div>

    </div>


  </div>
    <div class="form-group">

  <div class="panel panel-default">
      <div class="panel-heading box-heading" style="color:#0a819c;" align="center">Importe Recibido</div>
      <div class="panel-body"><h4 class="box-heading" align="center">S/. 185</h4></div>
  </div>


    </div>

  <div class="form-group">

  <div class="panel panel-default">
      <div class="panel-heading box-heading" style="color:#0a819c;" align="center">Cambio</div>
      <div class="panel-body"><h4 class="box-heading" align="center" style="color: #f2994b;">S/. 185</h4></div>
  </div>




    </div>


    </div>
    <div class="col-md-6">
  <div id="Imprime">
  <div id="ticket">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----
      <strong>Sistema Inventario</strong>-----<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Sucursal: 'Carrera 9 Centro Comercial'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Fecha: '2016-04-25 03:59:32'<br><br>
      Vendedor: 'Felipe Sanchez'<br>
      Numero de Factura: '001-C00223334'<br>
      Cliente: Johan Salazar Burgos<br>
      Direccion: Calle 14 No 1e-13<br>
      Tel: 3136762722<br>
      <br>
    <table width="250" border="0">
      <thead>
             <tr>
               <th style="width: 100px;">Producto</th>
               <th style="width: 100px;">Cantidad</th>
               <th style="width: 100px;">P.U</th>
               <th style="width: 100px;">Total</th>
             </tr>
            </thead>

        <tbody id="entries">
              <tr>
                  <td>Acetaminofen</td>
                  <td style="width: 100px;" class="text-right">3</td>
                  <td class="text-right">$20.000</td>
                  <td class="text-right">$30.000</td>
               </tr>
               <tr>
                  <td>Dolex</td>
                  <td class="text-right">2</td>
                  <td class="text-right">$20.000</td>
                  <td class="text-right">$30.000</td>
               </tr>

        </tbody>
        <tfoot>

          <tr>
             <th colspan="3" class="text-right"><b>sTotal</b></th>
             <th class="text-right" id="total">$44.444</th>
          </tr>


        </tfoot>
      </table>
      <div class="clearfix"></div>
      <br>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¡Gracias por su compra!</p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.sisinvent.com.co</p>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Popayán-Colombia</p>

      <br><br>


    <div class="clearfix"></div>
    <br>
  </div>
    </div>
    <br>
  <div class="form-group">
  <div class="col-md-6">

   <p><a href="javascript:imprSelec('Imprime')" class="btn btn-info">Impimir Factura</a></p>

    </div>
  </div>
      </div>

  </div>
      </p>
     </div>
    </div>
   </div>
  </div>
      </div>
      @section('js')
        <script src="{{URL::to('/')}}/plantilla/js/imprimirfac.js"></script>
      @endsection


@stop
