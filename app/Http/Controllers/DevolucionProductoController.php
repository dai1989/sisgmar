<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\DevolucionProducto;
use App\DevolucionProductoDetalle;
use Carbon\Carbon;
use App\Http\Requests\DevolucionProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
class DevolucionProductoController extends Controller
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
              $devolucionproductos=DB::table('devolucion_productos as dp')
      ->join('detalle_devoproductos as de','dp.iddevolucionproducto','=','de.iddevolucionproducto')
      ->join('productos as prod','de.idproducto','=','prod.idproducto')
      ->select('dp.iddevolucionproducto','dp.fecha_hora','dp.impuesto','dp.estado','dp.total_venta','dp.observacion','prod.descripcion','prod.barcode','dp.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('dp.observacion','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('dp.created_at',[$fe_i, $fe_f])
                     -> orderBy('dp.iddevolucionproducto', 'asc')
                     ->groupBy('dp.iddevolucionproducto','dp.fecha_hora','dp.impuesto','dp.estado','dp.total_venta','dp.observacion','prod.descripcion','prod.barcode','dp.created_at')
                     ->paginate(7);
       
                   

      return view('devolucionproducto.index',["devolucionproductos"=>$devolucionproductos,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

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
    return view("devolucionproducto.create",["productos"=>$productos]);
  }

  public function store (DevolucionProductoRequest $request)
  {
    // dd($request);

    DB::beginTransaction();
    $devolucionproducto=new DevolucionProducto;
    $devolucionproducto->total_venta=$request->get('total_venta');
    $devolucionproducto->idusuario=$request->get('idusuario');

    $mytime = Carbon::now('America/Argentina/Salta');
    $devolucionproducto->fecha_hora=$mytime->toDateTimeString();
    $devolucionproducto->impuesto='21';
    $devolucionproducto->estado='Efectuado';
    $devolucionproducto->observacion=$request->get('observacion');
    $devolucionproducto->save();

    $idproducto = $request->get('idproducto');
    $cantidad = $request->get('cantidad');
    
    $precio_venta = $request->get('precio_venta');

    $cont = 0;

    while($cont < count($idproducto)){
      $detalle = new DevolucionProductoDetalle();
      $detalle->iddevolucionproducto= $devolucionproducto->iddevolucionproducto;
      $detalle->idproducto= $idproducto[$cont];
      $detalle->cantidad= $cantidad[$cont];
      
      $detalle->precio_venta= $precio_venta[$cont];
      $detalle->save();
      $cont=$cont+1;
    }
    DB::commit();
    $usuario=DB::table('users')
    ->where('id','=',$devolucionproducto->idusuario)
    ->first();

    flash('Su devolucion fue registrado por el usuario '.$usuario->name.' correctamente')->success()->important();

    return Redirect::to('devolucionproducto');

  }

  public function show($id)
  {
    $devolucionproductos=DB::table('devolucion_productos as e')
    ->join('detalle_devoproductos as de','e.iddevolucionproducto','=','de.iddevolucionproducto')
    ->select('e.iddevolucionproducto','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario','e.observacion')
    ->groupBy('e.iddevolucionproducto','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario','e.observacion')
    ->where('e.iddevolucionproducto','=',$id)
    ->first();
    //dd($estimacion);
    $detalles=DB::table('detalle_devoproductos as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.precio_venta')
    ->where('d.iddevolucionproducto','=',$id)
    ->get();
    // dd($detalles);
    $usuario=DB::table('users')
    ->where('id','=',$devolucionproductos->idusuario)
    ->first();
    return view("devolucionproducto.show",["devolucionproductos"=>$devolucionproductos,"detalles"=>$detalles,"usuario"=>$usuario]);

  }

 
   public function pdf(Request $request,$id)
   {
         $devolucionproducto=DB::table('devolucion_productos as e')
        ->join('detalle_devoproductos as de','e.iddevolucionproducto','=','de.iddevolucionproducto')
        ->select('e.iddevolucionproducto','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario','e.observacion')
        ->groupBy('e.iddevolucionproducto','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario','e.observacion')
        ->where('e.iddevolucionproducto','=',$id)
        ->first();

        $detalles = DevolucionProductoDetalle::join('productos','detalle_devoproductos.idproducto','=','productos.idproducto')
        ->select('detalle_devoproductos.cantidad','detalle_devoproductos.precio_venta',
        'productos.descripcion as producto')
        ->where('detalle_devoproductos.iddevolucionproducto','=',$id)
        ->orderBy('detalle_devoproductos.iddetalle_devoproductos','desc')->get();
        $config=DB::table('config')
                     ->first();

        $factura_name= sprintf('devolucionproducto-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('devolucionproducto.pdf',['devolucionproducto'=>$devolucionproducto,'detalles'=>$detalles,'config'=>$config]);
        return $pdf->download($factura_name);  
      }


 
  
}
