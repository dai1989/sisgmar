<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\MensualFormReques;

use App\Venta;

use App\DetalleVenta;

use App\Presupuesto;

use App\Categoria;

use App\DetalleMensual;
use App\Arqueo;
use App\ArqueoDetalle;
use App\Mensual;

use App\Persona;

use App\DetallePresupuesto; 
use App\Models\TipoPago;
use App\Models\Producto;
use App\Models\TipoFactura;
use DB;

use Carbon\Carbon;

use Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Collection;


class MensualController extends Controller
{
  public function __construct()
  {
     $this -> middleware('auth');
  
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
                 $mensual=DB::table('mensual as v')
      ->join('personas as p','v.persona_id','=','p.id')
      ->join('detalle_mensual as dv','v.idmensual','=','dv.idmensual')
      ->join('tipo_facturas as tp','v.tipofactura_id','=','tp.id')
      ->select('p.nombre','p.tipo_documento','p.tipo_persona','p.documento','p.apellido','p.id','v.idmensual','v.fecha_hora','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','tp.descripcion','p.apellido','p.condicion_iva','v.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('p.documento','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('v.created_at',[$fe_i, $fe_f])
                    ->orderBy('v.idmensual','desc')
      ->groupBy('p.nombre','p.tipo_documento','tipo_persona','p.documento','p.apellido','p.id','v.idmensual','v.fecha_hora','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado', 'v.total_venta','tp.descripcion','p.apellido','p.condicion_iva','v.created_at')
                    ->paginate(7);
                     $pago = DB::table('mensual_pago')->where('idmensual', $id)->get();

      return view('mensual.index',["mensual"=>$mensual,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio,'pago'=>$pago]);

    }

  }


 
  public function create()
  {
    $idmensual=DB::table('mensual')->max('idmensual')+1;
    $tipofactura_list = TipoFactura::all();
    $tipopago_list = TipoPago::all();
    $personas=DB::table('personas')->where('tipo_persona','=','Cliente Cuenta Corriente')->get();
    $productos = DB::table('productos as prod')
    
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock','prod.precio_venta')
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.idproducto','prod.stock','prod.precio_venta')
    ->get();
    $ven= Venta::all()->last();
		if ($ven==null) {
			$ven='1';
      return view("mensual.create",["personas"=>$personas,"productos"=>$productos,"ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'idmensual'=>$idmensual]);
    }
    else
    {
      return view("mensual.create",["personas"=>$personas,"productos"=>$productos,"ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
  }

  public function store (MensualFormReques $request)
  {


    $fecha= DB::table('mensual as v')
    ->select('v.fecha_hora')
    ->orderBy('idmensual','desc')
    ->first();
    $mytime = Carbon::now('America/Argentina/Mendoza');
    $ventaact=$mytime->toDateString();

    $ultimoid= DB::table('presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();
    $ultimodetalle= DB::table('detalle_presupuesto')
    ->orderBy('idpresupuesto','desc')
    ->first();

    $user = DB::table('mensual')
    ->where('persona_id', Input::get('persona_id'))
    ->where('estado','=' ,"Activo")
    ->first();

    if ($user == null || $user->estado == "Anulada" ){
      if ($request->get('persona_id') == null) {
        $persona=new Persona;
        $persona->tipo_persona='Cliente Cuenta Corriente';
        $persona->nombre=$request->get('nombre');
        $persona->apellido=$request->get('apellido');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->condicion_iva=$request->get('condicion_iva');
        $persona->documento=$request->get('documento');
        $persona->genero=$request->get('genero');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
        $persona->save();

        $ultimapersona = DB::table('personas')
        ->orderBy('id','desc')
        ->first();

        DB::beginTransaction();
        $mensual=new Mensual;
        $mensual->persona_id=$ultimapersona->id;
        $mensual->tipo_comprobante=$request->get('tipo_comprobante');
        $mensual->num_comprobante=$request->get('num_comprobante');
        $mensual->total_venta=$request->get('total_venta');
        $mensual->idusuario=$request->get('idusuario');
        $mensual->tipofactura_id = $request -> get('tipofactura_id');
        $mensual->tipopago_id = $request -> get('tipopago_id');

        $mytime = Carbon::now('America/Argentina/Salta');
        $mensual->fecha_hora=$mytime->toDateTimeString();
        $mensual->impuesto='21';
        $mensual->estado='Activo';
        $mensual->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');
         $arqueo = Arqueo::where('estado', 'Abierto')->first();

          $ar = Arqueo::find($arqueo->idarqueo);
          $ar->total_dia = $arqueo->total_dia + 0;
          $ar->save();
          

        $cont = 0;
        $cont = 0;

        while($cont < count($idproducto)){
          $detalle = new DetalleMensual();
          $detalle->idmensual= $mensual->idmensual;
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
            $arde->tipo_venta= 'Corriente';
            $arde->tipo_pago= 'Corriente';
            $arde->descripcion= 'Se Vendio: ' . $ar->descripcion;
            $arde->total= $cantidad[$cont] * $precio_venta[$cont];
            $arde->save();
          $cont=$cont+1;
        }
        DB::commit();

      }
      else {
        DB::beginTransaction();
        $mensual=new Mensual;
        $mensual->persona_id=$request->get('persona_id');
        $mensual->tipo_comprobante=$request->get('tipo_comprobante');
        $mensual->num_comprobante=$request->get('num_comprobante');
        $mensual->total_venta=$request->get('total_venta');
        $mensual->idusuario=$request->get('idusuario');
        $mensual->tipofactura_id = $request -> get('tipofactura_id');
        $mensual->tipopago_id = $request -> get('tipopago_id');

        $mytime = Carbon::now('America/Argentina/Mendoza');
        $mensual->fecha_hora=$mytime->toDateTimeString();
        $mensual->impuesto='21';
        $mensual->estado='Activo';
        $mensual->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;
          $arqueo = Arqueo::where('estado', 'Abierto')->first();

          $ar = Arqueo::find($arqueo->idarqueo);
          $ar->total_dia = $arqueo->total_dia + $request->get('total_venta');
          $ar->save();
        while($cont < count($idproducto)){
          $detalle = new DetalleMensual();
          $detalle->idmensual= $mensual->idmensual;
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
            $arde->tipo_venta= 'Corriente';
            $arde->tipo_pago= 'Corriente';
            $arde->descripcion= 'Se Vendio: ' . $ar->descripcion;
            $arde->total= $cantidad[$cont] * $precio_venta[$cont];
            $arde->save();
          $cont=$cont+1;
        }
        DB::commit();
      }
    }
    elseif ($user->estado == "Activo") {

      $totalme = $user->total_venta + $request->get('total_venta');
      $mensual=Mensual::findOrFail($user->idmensual);
      $mensual->total_venta=$totalme;
      $mensual->idusuario=$request->get('idusuario');
      $mensual->update();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $descuento = $request->get('descuento');
      $precio_venta = $request->get('precio_venta');
      $cont = 0;
        $arqueo = Arqueo::where('estado', 'Abierto')->first();

        $ar = Arqueo::find($arqueo->idarqueo);
        $ar->total_dia = $arqueo->total_dia + $request->get('total_venta');
        $ar->save();
      while($cont < count($idproducto)){
        $detalle = new DetalleMensual();
        $detalle->idmensual= $user->idmensual;
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
          $arde->tipo_venta= 'Corriente';
          $arde->tipo_pago= 'Corriente';
          $arde->descripcion= 'Se Vendio: ' . $ar->descripcion;
          $arde->total= $cantidad[$cont] * $precio_venta[$cont];
          $arde->save();
        $cont=$cont+1;
      }
    }

    if (Presupuesto::exists()) {

      if ($ventaact == $fecha->fecha_hora) {
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

      }else {
        ;
        DB::beginTransaction();
        $presupuesto=new Presupuesto;
        if ($request->get('persona_id') == null) {
          $presupuesto->persona_id=	$fecha->persona_id;
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
    }
    else {
      DB::beginTransaction();
      $presupuesto=new Presupuesto;
      if ($request->get('persona_id') == null) {
        $presupuesto->persona_id=	$fecha->persona_id;
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
    $men= Mensual::all()->last();
    $per= Persona::findOrFail($men->persona_id);
    flash('Su venta del cliente, '.$per->nombre.' ha sido creada correctamente, en la fecha '.$men->fecha_hora=$mytime->format('d-m-Y'))->important();

    return Redirect::to('mensual');
  }

  public function show($id)
  {
    $mensual=DB::table('mensual as v')
    ->join('personas as p','v.persona_id','=','p.id')
    ->join('detalle_mensual as dv','v.idmensual','=','dv.idmensual')
    ->join('tipo_facturas as tp','v.tipofactura_id','=','tp.id')
    ->select('v.idmensual','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','tp.descripcion','p.apellido','p.condicion_iva')
    ->groupBy('v.idmensual','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','tp.descripcion','p.apellido','p.condicion_iva')
    ->where('v.idmensual','=',$id)
    ->first();
    //dd($venta);
    $detalles=DB::table('detalle_mensual as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idmensual','=',$id)
    ->get();
    $usuario=DB::table('users')
    ->where('id','=',$mensual->idusuario)
    ->first();
     $pago = DB::table('mensual_pago')->where('idmensual', $id)->get();
    return view("mensual.show",["venta"=>$mensual,"detalles"=>$detalles,"usuario"=>$usuario,'pago'=>$pago]);

  }

  public function destroy($id)
  {
    $venta=Mensual::findOrFail($id);
    $venta->estado='Cancelado';
    $venta->update();
    $per= Persona::findOrFail($venta->persona_id);
    flash('Su venta del cliente, '.$per->nombre.' ha sido cancelada y dada como pagada correctamente')->success()->important();

    return Redirect::to('mensual');
  }

   public function pdf(Request $request,$id){
        $mensual=DB::table('mensual as v')
          ->join('personas as p','v.persona_id','=','p.id')
          ->join('detalle_mensual as dv','v.idmensual','=','dv.idmensual')
          ->select('v.idmensual','v.fecha_hora','p.nombre','p.documento','p.apellido','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.tipo_documento')
          ->groupBy('v.idmensual','v.fecha_hora','p.nombre','p.tipo_documento','p.apellido','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.documento','p.tipo_documento','p.condicion_iva')
          ->where('v.idmensual','=',$id)
          ->first();

        $detalles=DB::table('detalle_mensual as d')
           ->join('productos as prod','d.idproducto','=','prod.idproducto')
           ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
           ->where('d.idmensual','=',$id)
           ->get();
       $usuario=DB::table('users') 
             ->where('id','=',$mensual->idusuario)
             ->first();
       $config=DB::table('config')
                ->first();

        $factura_name= sprintf('mensual-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('mensual.pdf',['mensual'=>$mensual,'detalles'=>$detalles,'config'=>$config,'usuario'=>$usuario]);
        return $pdf->download($factura_name);  
      }


}
 