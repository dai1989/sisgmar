<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\IngresoFormRequest;

use App\Ingreso;
use App\Arqueo;
use App\ArqueoDetalle;
use App\Models\Persona;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\DetalleIngreso;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

use Carbon\Carbon;

use Response;

use Illuminate\Support\Collection;

class IngresoController extends Controller
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
                $ingresos=DB::table('ingreso as i')
                ->join('proveedores as p','i.proveedor_id','=','p.id')
                ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
                ->select('i.created_at','p.razonsocial','p.cuit','p.id','i.idingreso','i.fecha_hora','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('i.num_comprobante','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('i.created_at',[$fe_i, $fe_f])
                     ->orderBy('i.idingreso','desc')
                    ->groupBy('p.razonsocial','p.cuit','p.id','i.idingreso','i.fecha_hora','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado','i.created_at')
                    ->paginate(7);

      return view('ingreso.index',["ingresos"=>$ingresos,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 
  public function create()
  {
    $tipofactura_list = TipoFactura::all();
    $tipopago_list = TipoPago::all();
    $proveedores=Proveedor::all();
    $productos = DB::table('productos as prod')
    ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock','prod.precio_venta')
    ->where('prod.estado','=','Activo')
    ->get();
    $ing= Ingreso::all()->last();
    if ($ing==null) {
      $ing='1';
      return view("ingreso.create",["proveedores"=>$proveedores,"productos"=>$productos,"ing"=>$ing,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
    else
    {
      $ing= Ingreso::all()->last();
      return view("ingreso.create",["proveedores"=>$proveedores,"productos"=>$productos,"ing"=>$ing,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list]);
    }
  }

  public function store (IngresoFormRequest $request)
  {

    // dd($request);
    if ($request->get('proveedor_id') == null) {
      $proveedor=new Proveedor;
      
      $proveedor->razonsocial=$request->get('razonsocial');
      $proveedor->cuit=$request->get('cuit');
      $proveedor->condicion_iva=$request->get('condicion_iva');
     
      $proveedor->save();

      $ultimapersona = DB::table('proveedores')
      ->orderBy('id','desc')
      ->first();

      DB::beginTransaction();
      $ingreso=new Ingreso;
      $ingreso->proveedor_id=$ultimapersona->id;
      $ingreso->serie_comprobante=$request->get('serie_comprobante');
      $ingreso->num_comprobante=$request->get('num_comprobante');
      $ingreso -> tipofactura_id = $request -> get('tipofactura_id');
      $ingreso -> tipopago_id = $request -> get('tipopago_id');

      $mytime = Carbon::now('America/Argentina/Mendoza');
      $ingreso->fecha_hora=$mytime->toDateTimeString();
      $ingreso->impuesto='21';
      $ingreso->estado='Efectuado';
      $ingreso->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $precio_compra = $request->get('precio_compra');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleIngreso();
        $detalle->idingreso= $ingreso->idingreso;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->precio_compra= $precio_compra[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
      

       
      DB::commit();

      

    }
    else {

      DB::beginTransaction();
      $ingreso=new Ingreso;
      $ingreso->proveedor_id=$request->get('proveedor_id');
      $ingreso->serie_comprobante=$request->get('serie_comprobante');
      $ingreso->num_comprobante=$request->get('num_comprobante');
      $ingreso -> tipofactura_id = $request -> get('tipofactura_id');
      $ingreso -> tipopago_id = $request -> get('tipopago_id');
      $mytime = Carbon::now('America/Argentina/Mendoza');
      $ingreso->fecha_hora=$mytime->toDateTimeString();
      $ingreso->impuesto='21';
      $ingreso->estado='Efectuado';
      $ingreso->save();

      $idproducto = $request->get('idproducto');
      $cantidad = $request->get('cantidad');
      $precio_compra = $request->get('precio_compra');
      $precio_venta = $request->get('precio_venta');

      $cont = 0;

      while($cont < count($idproducto)){
        $detalle = new DetalleIngreso();
        $detalle->idingreso= $ingreso->idingreso;
        $detalle->idproducto= $idproducto[$cont];
        $detalle->cantidad= $cantidad[$cont];
        $detalle->precio_compra= $precio_compra[$cont];
        $detalle->precio_venta= $precio_venta[$cont];
        $detalle->save();
        $cont=$cont+1;
      }
     
      DB::commit();
     
    }
    $ing= Ingreso::all()->last();
    $pro= Proveedor::findOrFail($ing->proveedor_id);
    flash('Su ingreso, del proveedor '.$pro->razonsocial.' ha sido creado correctamente')->important();
    return Redirect::to('ingreso');
  }

  public function show($id)
  {
    $ingreso=DB::table('ingreso as i')
    ->join('proveedores as p','i.proveedor_id','=','p.id')
    ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    ->join('tipo_facturas as tp','i.tipofactura_id','=','tp.id')
    ->select('i.idingreso','i.fecha_hora','p.razonsocial','p.cuit','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado','tp.descripcion',DB::raw('sum(di.cantidad*precio_compra) as total'))
    ->groupBy('i.idingreso','i.fecha_hora','p.razonsocial','p.cuit','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado','tp.descripcion')
    ->where('i.idingreso','=',$id)
    ->first();

    $detalles=DB::table('detalle_ingreso as d')
    ->join('productos as prod','d.idproducto','=','prod.idproducto')
    ->select('d.created_at','prod.descripcion as producto','d.cantidad','d.precio_compra','d.precio_venta')
    ->where('d.idingreso','=',$id)
    ->get();
    return view("ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
  }

  public function destroy($id)
  {
    $ingreso=Ingreso::findOrFail($id);
    $ingreso->Estado='Anulado';
    $ingreso->update();
    $ing= Ingreso::findOrFail($id);
    $pro= Proveedor::findOrFail($ing->proveedor_id);
    flash('Su ingreso, del proveedor '.$pro->razonsocial.' ha sido cancelada correctamente')->success()->important();
    return Redirect::to('ingreso');
  }
   public function pdf(Request $request,$id){
       $ingreso=DB::table('ingreso as i')
      ->join('proveedores as p','i.proveedor_id','=','p.id')
      ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
      ->select('i.idingreso','i.fecha_hora','p.razonsocial','p.condicion_iva','p.cuit','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
      ->groupBy('i.idingreso','i.fecha_hora','p.razonsocial','p.condicion_iva','p.cuit','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
      ->where('i.idingreso','=',$id)
      ->orderBy('i.idingreso','desc')->take(1)->get();

        $detalles = DetalleIngreso::join('productos','detalle_ingreso.idproducto','=','productos.idproducto')
        ->select('detalle_ingreso.cantidad','detalle_ingreso.precio_compra',
        'productos.descripcion as producto')
        ->where('detalle_ingreso.idingreso','=',$id)
        ->orderBy('detalle_ingreso.iddetalle_ingreso','desc')->get();
        $config=DB::table('config')
                     ->first();
 
        $factura_name= sprintf('comprobante-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('ingreso.pdf',['ingreso'=>$ingreso,'detalles'=>$detalles,'config'=>$config]);
        return $pdf->download($factura_name);  
      }
}
