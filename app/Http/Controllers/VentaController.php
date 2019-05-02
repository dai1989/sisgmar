<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\VentasFormRequest;
use Flash;
use App\Venta; 

use App\DetalleVenta;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\Devolucion;
use App\Presupuesto;

use App\Categoria;

use App\Persona;
use App\Models\Cliente;
use App\Models\Producto;

use App\DetallePresupuesto;

use DB;

use Carbon\Carbon;
use App\Arqueo;
use App\ArqueoPago;
use App\ArqueoDetalle;
use Response;

use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade as PDF;

class VentaController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

public function index(Request $request)
  {
    if ($request)
    {
      $quer=trim($request->get('searchText'));
      $inicio = $request->inicio;
      $fin = $request->fin;
            $mytime = Carbon::parse($inicio);
            $mytime2 = Carbon::parse($fin);


            if ($inicio == null){
                $fe_i = '2000-01-01';
            }else{
                $fe_i = $mytime->toDateTimeString();
            }

            if ($fin == null){
                $fe_f = '4000-01-01';
            }else{
                $fe_f = $mytime2->toDateTimeString();
            }
                $ventas=DB::table('venta as v')
                    ->join('personas as p','v.persona_id','=','p.id')
                    ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                    ->join('tipo_facturas as tp','v.tipofactura_id','=','tp.id')
                     ->select('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.tipo_persona','p.documento','p.id','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','tp.descripcion','p.apellido','p.condicion_iva','v.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('v.num_comprobante','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('v.created_at',[$fe_i, $fe_f])
                    ->orderBy('v.idventa','desc')
                    ->groupBy('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.tipo_persona','p.documento','p.id','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','tp.descripcion','p.apellido','p.condicion_iva','v.created_at')
                    ->paginate(7);

      return view('venta.index',["ventas"=>$ventas,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }



  public function create()
  {
    $tipofactura_list = TipoFactura::all(); 
    $tipopago_list = TipoPago::all();
    $devoluciones = Devolucion::all();
    $personas=Persona::all();
    $productos = DB::table('productos as prod')
    
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock','prod.precio_venta')
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.idproducto','prod.stock','prod.precio_venta')
    ->get();
    $ven= Venta::all()->last();
    if ($ven==null) {
      $ven='1';
      return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'devoluciones'=>$devoluciones]);
      }
      else
      {
        return view("venta.create",["personas"=>$personas,"productos"=>$productos, "ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'devoluciones'=>$devoluciones]);
      }


  }

  public function store (VentasFormRequest $request)
  {
     
       


    $fecha= DB::table('venta as v')
    ->orderBy('idventa','desc')
    ->first();
    $mytime = Carbon::now('America/Argentina/Mendoza');
    $ventaact=$mytime->toDateString();

    $ultimoid= DB::table('presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();
    $ultimodetalle= DB::table('detalle_presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();

    if ($request->get('persona_id') == null) {
      $persona=new Persona;
      
      $persona->nombre=$request->get('nombre');
      $persona->apellido=$request->get('apellido');
      $persona->tipo_documento=$request->get('tipo_documento');
      $persona->tipo_persona=$request->get('tipo_persona');
      $persona->condicion_iva=$request->get('condicion_iva');
      $persona->documento=$request->get('documento');
      $persona->genero=$request->get('genero');
      $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
      $persona->save();
      $cliente = new Cliente (); 
      $cliente->persona_id= $persona->id;
      $cliente->save();

      $ultimapersona = DB::table('personas')
      ->orderBy('id','desc')
      ->first();

      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$ultimapersona->id;
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$request->get('total_venta');
      $venta->idusuario=$request->get('idusuario');
      $venta->entrega=$request->entrega;
      $venta->pago_tarjeta=$request->pago_tarjeta;
      $venta->debito=$request->debito;
      $venta->tipofactura_id = $request -> get('tipofactura_id');
      $venta->tipopago_id = $request -> get('tipopago_id');
      $venta->iddevolucion = $request -> get('iddevolucion');

      $mytime = Carbon::now('America/Argentina/Salta');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='21';
      $venta->estado='Efectuado';
      $venta->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      if ($request->entrega != 0){
                $pago = 'Efectivo';
            }
            if ($request->debito != 0){
                $pago = $pago .  ', Tarjeta de Debito';
            }
            if ($request->pago_tarjeta != 0){
                $pago = $pago .  ', Tarjeta de Credito';
            }

            $arqueo = Arqueo::where('estado', 'Abierto')->first();

           $ar = Arqueo::find($arqueo->idarqueo);
            $ar->total_dia = $arqueo->total_dia + $request->get('total_venta');
            $ar->save();
            $pago = New ArqueoPago();
            $pago->idarqueo =  $arqueo->idarqueo;
            $pago->idventa = $venta->idventa;
            $pago->idingreso = 0;
            $pago->tipo_pago = 'Venta';
            $pago->pago_efectivo = $request->entrega;
            $pago->pago_debito = $request->debito;
            $pago->pago_credito = $request->pago_tarjeta;
            $pago->monto =  $request->get('total_venta');
            $pago->save();

      while($cont < count($idproducto)){
        $detalle = new DetalleVenta();
        $detalle->idventa= $venta->idventa;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $ar = Producto::find($idproducto[$cont]);

                $arde = New ArqueoDetalle();
                $arde->idarqueo = $ar->idarqueo;
                $arde->monto= $precio_venta[$cont];
                $arde->cantidad= $cantidad[$cont];
                $arde->tipo_venta= 'Venta';
                $arde->tipo_pago= $pago;
                $arde->descripcion= 'Se Vendio: ' . $ar->descripcion;
                $arde->total= $cantidad[$cont] * $precio_venta[$cont];
                $arde->save();
        $cont=$cont+1;
      }
      DB::commit();
    }
    else {
      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$request->get('persona_id');
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$request->get('total_venta');
      $venta->idusuario=$request->get('idusuario');
      $venta->entrega=$request->entrega;
      $venta->pago_tarjeta=$request->pago_tarjeta;
      $venta->debito=$request->debito;
      $venta->tipofactura_id = $request -> get('tipofactura_id');
      $venta->tipopago_id = $request -> get('tipopago_id');
      $venta->iddevolucion = $request -> get('iddevolucion');

      $mytime = Carbon::now('America/Argentina/Salta');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='21';
      $venta->estado='Efectuado';
      $venta->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');
      if ($request->entrega != 0){
                $pago = 'Efectivo';
            }
            if ($request->debito != 0){
                $pago = $pago .  ', Tarjeta de Debito';
            }
            if ($request->pago_tarjeta != 0){
                $pago = $pago . ', Tarjeta de Credito';
            }

            $arqueo = Arqueo::where('estado', 'Abierto')->first();
//            dd($arqueo);

              $ar = Arqueo::find($arqueo->idarqueo);
            $ar->total_dia = $arqueo->total_dia + $request->get('total_venta');
            $ar->save();
            $pago = New ArqueoPago();
            $pago->idarqueo =  $arqueo->idarqueo;
            $pago->idventa = $venta->idventa;
            $pago->idingreso = 0;
            $pago->tipo_pago = 'Venta';
            $pago->pago_efectivo = $request->entrega;
            $pago->pago_debito = $request->debito;
            $pago->pago_credito = $request->pago_tarjeta;
            $pago->monto =  $request->get('total_venta');
            $pago->save();

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleVenta();
        $detalle->idventa= $venta->idventa;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $ar = Producto::find($idproducto[$cont]);

                $arde = New ArqueoDetalle();
                $arde->idarqueo = $arqueo->idarqueo;
                $arde->monto= $precio_venta[$cont];
                $arde->cantidad= $cantidad[$cont];
                $arde->tipo_venta= 'Venta';
                $arde->tipo_pago= $pago;
                $arde->descripcion= 'Se Vendio: ' . $ar->descripcion;
                $arde->total= $cantidad[$cont] * $precio_venta[$cont];
                $arde->save();
        
        $cont=$cont+1;
        
      }
      DB::commit();
    }


    if (Presupuesto::exists()) {

      if ( $ventaact == $fecha->fecha_hora) {
        $totalpro = $ultimoid->total_venta + $request->get('total_venta');
        $venta=Presupuesto::findOrFail($ultimoid->idpresupuesto);
        $venta->total_venta=$totalpro;
        $venta->update();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
          $detalle = new DetallePresupuesto();
          $detalle->idpresupuesto= $ultimoid->idpresupuesto;
          $detalle->idproducto= $idproducto[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->save();
          $cont=$cont+1;
        }

      }
      else {

        DB::beginTransaction();
        $presupuesto=new Presupuesto;
        if ($request->get('persona_id') == null) {
          $presupuesto->persona_id=  $fecha->persona_id;
        }
        else {
          $presupuesto->persona_id=$request->get('persona_id');
        }
        $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');

        $presupuesto->num_comprobante=$request->get('num_comprobante');
        $presupuesto->total_venta=$request->get('total_venta');
        $presupuesto->idusuario=$request->get('idusuario');
        $presupuesto->tipofactura_id = $request -> get('tipofactura_id');
        $presupuesto->tipopago_id = $request -> get('tipopago_id');
        $presupuesto->iddevolucion = $request -> get('iddevolucion');

        $mytime = Carbon::now('America/Argentina/Salta');
        $presupuesto->fecha_hora=$mytime->toDateTimeString();
        $presupuesto->impuesto='21';
        $presupuesto->estado='Efectuado';
        $presupuesto->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
          $detalle = new DetallePresupuesto();
          $detalle->idpresupuesto= $presupuesto->idpresupuesto;
          $detalle->idproducto= $idproducto[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->save();
          $cont=$cont+1;
        }
        DB::commit();
      }
    }
    else {
    
      DB::beginTransaction();
      $presupuesto=new Presupuesto;
      if ($request->get('persona_id') == null) {
        $presupuesto->persona_id=  $fecha->persona_id;
      }
      else {
        $presupuesto->persona_id=$request->get('persona_id');
      }
      $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');
      $presupuesto->num_comprobante=$request->get('num_comprobante');
      $presupuesto->total_venta=$request->get('total_venta');
      $presupuesto->idusuario=$request->get('idusuario');
      $presupuesto->tipofactura_id = $request -> get('tipofactura_id');
      $presupuesto->tipopago_id = $request -> get('tipopago_id');
      $presupuesto->iddevolucion = $request -> get('iddevolucion');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $presupuesto->fecha_hora=$mytime->toDateTimeString();
      $presupuesto->impuesto='21';
      $presupuesto->estado='Efectuado';
      $presupuesto->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetallePresupuesto();
        $detalle->idpresupuesto= $presupuesto->idpresupuesto;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      DB::commit();

    }
    $ven= Venta::all()->last();
    flash('Su venta, del día '.$ven->fecha_hora=$mytime->format('d-m-Y').' ha sido creada correctamente')->important();

    return Redirect::to('venta');
  }

  public function show($id)
  {
    $venta=DB::table('venta as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    ->join('tipo_pagos as tp','v.tipopago_id','=','tp.id')
    ->join('tipo_facturas as tf','v.tipofactura_id','=','tf.id')
    ->select('v.idventa','p.id','v.entrega','v.pago_tarjeta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.apellido','tp.descripcionpago','tf.descripcion','v.debito','p.documento')
    ->groupBy('v.idventa','p.id','v.entrega','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.apellido','v.pago_tarjeta','tp.descripcionpago','tf.descripcion','v.debito','p.documento')
    ->where('v.idventa','=',$id)
    ->first();
    //dd($venta);
    $detalles=DB::table('detalle_venta as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta', 'd.idproducto')
    ->where('d.idventa','=',$id)
    ->get();
    $usuario=DB::table('users')
    ->where('id','=',$venta->idusuario)
    ->first();
    $devo = DB::table('devolucions')->get();

    return view("venta.show",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario, "devo"=>$devo]);

  }


  public function ticke($id)
  {

    $venta=DB::table('venta as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    ->join('tipo_pagos as tp','v.tipopago_id','=','tp.id')
    ->select('v.idventa','v.entrega','v.pago_tarjeta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','tp.descripcionpago','v.debito','p.documento','p.apellido')
    ->groupBy('v.idventa','v.entrega','v.pago_tarjeta','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','tp.descripcionpago','v.debito','p.documento','p.apellido')
    ->where('v.idventa','=',$id)
    ->first();
    // dd($venta);
    $detalles=DB::table('detalle_venta as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idventa','=',$id)
    ->get();
    $usuario=DB::table('users')
    ->where('id','=',$venta->idusuario)
    ->first();
    $config=DB::table('config')
                     ->first();
    return view("venta.tickes",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario,'config'=>$config]);

  }
   public function pdf(Request $request,$id){
         $venta = Venta::join('personas','venta.persona_id','=','personas.id')
        ->join('users','venta.idusuario','=','users.id')
        ->join('tipo_pagos as tp','venta.tipopago_id','=','tp.id')
        ->select('venta.idventa',
        'venta.num_comprobante','venta.fecha_hora','venta.impuesto','venta.total_venta','venta.entrega','venta.pago_tarjeta',
        'venta.estado','personas.nombre','personas.apellido','personas.documento','personas.tipo_documento','users.name','tp.descripcionpago','venta.debito')
        ->where('venta.idventa','=',$id)
        ->orderBy('venta.idventa','desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalle_venta.idproducto','=','productos.idproducto')
        ->select('detalle_venta.cantidad','detalle_venta.precio_venta','detalle_venta.descuento',
        'productos.descripcion as producto')
        ->where('detalle_venta.idventa','=',$id)
        ->orderBy('detalle_venta.iddetalle_venta','desc')->get();
        $config=DB::table('config')
                     ->first();
         $devo = DB::table('devolucions')->get();

        $factura_name= sprintf('venta-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('venta.pdf',['venta'=>$venta,'detalles'=>$detalles,'config'=>$config,'devo'=>$devo]);
        return $pdf->download($factura_name);  
      }

  public function destroy($id)
  {
    $venta=Venta::findOrFail($id);
    $venta->Estado='Anulada';
    $venta->update();
    $mytime = Carbon::now();
    flash('Su venta, del día '.date("d-m-Y", strtotime($venta->fecha_hora)).' ha sido anulada correctamente')->success()->important();
    return Redirect::to('venta');
  }
}
