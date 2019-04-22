<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta cta cte</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
 
        #imagen{
        width: 100px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        
        <header>
            <div id="logo">
                <img src="{{asset('imagenes/config/'.$config -> imagen)}}" alt="{{$config -> imagen}}" height="100px" width="100px" class="img-thumbnail">
            </div>
            <div id="datos">
                <p id="encabezado">
                     <b>{{$config->nombre}}</b><br>{{$config->direccion}}<br>Telefono:{{$config->telefono}}<br>Email: {{$config->correo}}
                    <br>Cuit:{{$config->cuit}}<br>Condicion frente al IVA: {{$config->condicion_iva}}
                </p>
            </div>
            <div id="fact">
                <p>{{$mensual->descripcion}}<br> 
                N°{{$mensual->num_comprobante}}</p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a). {{$mensual->nombre}},{{$mensual->apellido}}<br>
                            {{$mensual->tipo_documento}}: {{$mensual->documento}}<br>
                           
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
       
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>VENDEDOR</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->name}}</td> 
                            <td>{{$mensual->fecha_hora}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            
                            <th>DESCRIPCION</th>
                            <th>CANT</th>
                            <th>PRECIO UNIT</th>
                            <th>DESC.</th>
                            <th>PRECIO TOTAL</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->producto}}</td>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->precio_venta}}</td>
                            <td>{{$det->descuento}}</td>
                            <td>{{$det->cantidad*$det->precio_venta-$det->descuento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>SUBTOTAL</th>
                            <td>$ {{round($mensual->total_venta/1.21)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>IVA</th>
                            <td>$ {{round($mensual->total_venta-$mensual->total_venta/1.21,2)}}</td>
                        </tr>
                       
                        
                         
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>$ {{$mensual->total_venta}}</td>
                        </tr>
                       
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>¡¡Gracias por su compra!!</b></p>
            </div>
        </footer>
    </body>
</html>