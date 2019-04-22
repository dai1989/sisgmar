<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Collection;

use App\Http\Requests\EstimacionRequest;

use App\Estimacion;

use App\DetalleEstimacion;

use App\Venta;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\DetalleVenta;

use App\Presupuesto;

use App\Categoria;
use App\Config;

use App\Models\Persona;

use App\DetallePresupuesto;

use DB;

use Carbon\Carbon;

use Response;

use GameSettingsTrait;
use Barryvdh\DomPDF\Facade as PDF;
class EstimacionController extends Controller
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
                $estimacion=DB::table('estimacion as e')
      ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
      ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('e.fecha_hora','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('e.created_at',[$fe_i, $fe_f])
                    ->orderBy('e.idestimacion','desc')
                     ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.created_at')
                    ->paginate(7);

      return view('estimacion.index',["estimacion"=>$estimacion,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }




 
  public function create()
  {
    $productos = DB::table('productos as prod')
    ->join('detalle_ingreso as di', 'prod.idproducto', '=', 'di.idproducto' )
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto','prod.imagen','prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
    ->where('prod.estado','=','Activo')
    ->where('prod.stock','>','0')
    ->groupBy('producto','prod.idproducto','prod.stock','prod.imagen','prod.precio_venta')
    ->get();
    //  dd($articulos);
    return view("estimacion.create",["productos"=>$productos]);
  }

  public function store (EstimacionRequest $request)
  {
    // dd($request);

    DB::beginTransaction();
    $estimacion=new Estimacion;
    $estimacion->total_venta=$request->get('total_venta');
    $estimacion->idusuario=$request->get('idusuario');

    $mytime = Carbon::now('America/Argentina/Mendoza');
    $estimacion->fecha_hora=$mytime->toDateTimeString();
    $estimacion->impuesto='21';
    $estimacion->estado='Venta Sin Realizar';
    $estimacion->save();

    $idproducto = $request->get('idproducto');
    $cantidad = $request->get('cantidad');
    $descuento = $request->get('descuento');
    $precio_venta = $request->get('precio_venta');

    $cont = 0;

    while($cont < count($idproducto)){
      $detalle = new DetalleEstimacion();
      $detalle->idestimacion= $estimacion->idestimacion;
      $detalle->idproducto= $idproducto[$cont];
      $detalle->cantidad= $cantidad[$cont];
      $detalle->descuento= $descuento[$cont];
      $detalle->precio_venta= $precio_venta[$cont];
      $detalle->save();
      $cont=$cont+1;
    }
    DB::commit();
    $usuario=DB::table('users')
    ->where('id','=',$estimacion->idusuario)
    ->first();

    flash('Su presupuesto fue registrado por el usuario '.$usuario->name.' correctamente')->success()->important();

    return Redirect::to('estimacion');

  }

  public function show($id)
  {
    $estimacion=DB::table('estimacion as e')
    ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
    ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
    ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
    ->where('e.idestimacion','=',$id)
    ->first();
    //dd($estimacion);
    $detalles=DB::table('detalle_estimacion as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idestimacion','=',$id)
    ->get();
    // dd($detalles);
    $usuario=DB::table('users')
    ->where('id','=',$estimacion->idusuario)
    ->first();
    return view("estimacion.show",["estimacion"=>$estimacion,"detalles"=>$detalles,"usuario"=>$usuario]);

  }

  public function estimacionventa($id)
  {
    $tipofactura_list = TipoFactura::all();
    $tipopago_list = TipoPago::all();
    $personas=Persona::all();
    // dd($personas);
    $estimacion=DB::table('estimacion as e')
    ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
    ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
    ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
    ->where('e.idestimacion','=',$id)
    ->first();
    //dd($estimacion);
    $detalles=DB::table('detalle_estimacion as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.idproducto','prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
    ->where('d.idestimacion','=',$id)
    ->get();
    $ven= Venta::all()->last();
    if ($ven==null)
    {
      $ven='1';
     return view("estimacion.estimacionventa",["estimacion"=>$estimacion,"detalles"=>$detalles,"personas"=>$personas,"ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
    else {
      return view("estimacion.estimacionventa",["estimacion"=>$estimacion,"detalles"=>$detalles,"personas"=>$personas,"ven"=>$ven,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
  }
   public function pdf(Request $request,$id)
   {
         $estimacion=DB::table('estimacion as e')
        ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
        ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
        ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
        ->where('e.idestimacion','=',$id)
        ->first();

        $detalles = DetalleEstimacion::join('productos','detalle_estimacion.idproducto','=','productos.idproducto')
        ->select('detalle_estimacion.cantidad','detalle_estimacion.precio_venta','detalle_estimacion.descuento',
        'productos.descripcion as producto')
        ->where('detalle_estimacion.idestimacion','=',$id)
        ->orderBy('detalle_estimacion.iddetalle_estimacion','desc')->get();
        $config=DB::table('config')
                     ->first();

        $factura_name= sprintf('estimacion-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('estimacion.pdf',['estimacion'=>$estimacion,'detalles'=>$detalles,'config'=>$config]);
        return $pdf->download($factura_name);  
      }


  public function crearventa(Request $request)
  {

    $esti=DB::table('estimacion')
    ->where('idestimacion','=',$request->idestimacion)
    ->first();
    // dd($esti->estado);

    if ($esti->estado == "Venta Sin Realizar") {
      $estimacion=DB::table('estimacion as e')
      ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
      ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
      ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
      ->where('e.idestimacion','=',$request->idestimacion)
      ->first();

      $detalles=DB::table('detalle_estimacion as d')
      ->join('productos as a','d.idproducto','=','a.idproducto')
      ->select('a.idproducto','a.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta','iddetalle_estimacion')
      ->where('d.idestimacion','=',$request->idestimacion)
      ->get();


      $fecha= DB::table('venta as v')
      ->orderBy('idventa','desc')
      ->first();
      $mytime = Carbon::now('America/Argentina/Salta');
      $ventaact=$mytime->toDateString();

      $ultimoid= DB::table('presupuesto')
      ->orderBy('idpresupuesto','desc')
      ->first();
      $ultimodetalle= DB::table('detalle_presupuesto')
      ->orderBy('idpresupuesto','desc')
      ->first();

      foreach ($detalles as $detalle){
        $arti[] = $detalle->idproducto;
        $cant[] = $detalle->cantidad;
        $desc[] = $detalle->descuento;
        $pre[] = $detalle->precio_venta;
      }
      // $fe = "";
        //  dd(isset($fecha->fecha_hora));

      if (Presupuesto::exists() && isset($fecha->fecha_hora) == true) {
          // dd(isset($fecha->fecha_hora));
        if ( $ventaact == $fecha->fecha_hora) {
          $totalpro = $ultimoid->total_venta + $estimacion->total_venta;
          $venta=Presupuesto::findOrFail($ultimoid->idpresupuesto);
          $venta->total_venta=$totalpro;
          $venta->update();

          $idproducto = $arti;
          $cantidad = $cant;
          $descuento = $desc;
          $precio_venta = $pre;
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
          $presupuesto->persona_id=$request->get('persona_id');
          $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');
          $presupuesto->num_comprobante=$request->get('num_comprobante');
          $presupuesto->total_venta= $estimacion->total_venta;
          $presupuesto->idusuario=$request->get('idusuario');
          $presupuesto->tipofactura_id = $request -> get('tipofactura_id');
          $presupuesto->tipopago_id = $request -> get('tipopago_id');

          $mytime = Carbon::now('America/Argentina/Salta');
          $presupuesto->fecha_hora=$mytime->toDateTimeString();
          $presupuesto->impuesto='21';
          $presupuesto->estado='Efectuado';
          $presupuesto->save();


          $idproducto = $arti;
          $cantidad = $cant;
          $descuento = $desc;
          $precio_venta = $pre;

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
        $presupuesto->persona_id=$request->get('persona_id');
        $presupuesto->tipo_comprobante=$request->get('tipo_comprobante');
        $presupuesto->num_comprobante=$request->get('num_comprobante');
        $presupuesto->total_venta= $estimacion->total_venta;
        $presupuesto->idusuario=$request->get('idusuario');
         $presupuesto->tipofactura_id = $request -> get('tipofactura_id');
        $presupuesto->tipopago_id = $request -> get('tipopago_id');

        $mytime = Carbon::now('America/Argentina/Salta');
        $presupuesto->fecha_hora=$mytime->toDateTimeString();
        $presupuesto->impuesto='21';
        $presupuesto->estado='Efectuado';
        $presupuesto->save();

        $idproducto = $arti;
        $cantidad = $cant;
        $descuento = $desc;
        $precio_venta = $pre;

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

      DB::beginTransaction();
      $venta=new Venta;
      $venta->persona_id=$request->get('persona_id');
      $venta->tipo_comprobante=$request->get('tipo_comprobante');
      $venta->num_comprobante=$request->get('num_comprobante');
      $venta->total_venta=$estimacion->total_venta;
      $venta->idusuario=$request->get('idusuario');
      $venta->entrega=$request->get('entrega');
      $venta->pago_tarjeta=$request->get('pago_tarjeta');
      $venta->debito=$request->get('debito');
       $venta->tipofactura_id = $request -> get('tipofactura_id');
        $venta->tipopago_id = $request -> get('tipopago_id');

      $mytime = Carbon::now('America/Argentina/Salta');
      $venta->fecha_hora=$mytime->toDateTimeString();
      $venta->impuesto='21';
      $venta->estado='Efectuado';
      $venta->save();

      $idproducto = $arti;
      $cantidad = $cant;
      $descuento = $desc;
      $precio_venta = $pre;

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleVenta();
        $detalle->idventa= $venta->idventa;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->descuento= $descuento[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      DB::commit();

      $venta=Estimacion::findOrFail($request->idestimacion);
      $venta->estado='Venta Realizada';
      $venta->update();
      flash('Su venta fue registrada correctamente')->important();
      return Redirect::to('venta');

    }
    else {
      flash('Su venta ya fue registrada, si desea, haga un nuevo presupuesto y realize una nueva venta. O Cree una nueva venta.')->warning()->important();

      return Redirect::to('estimacion');
    }

  }
}
