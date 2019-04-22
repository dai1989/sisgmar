<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\PresupuestoFormRequest;
use App\Models\Persona;
use App\Models\Cliente;

use App\Presupuesto;
use App\Models\TipoPago;
use App\Models\TipoFactura;
use App\DetallePresupuesto;

use DB;

use Carbon\Carbon;

use Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Collection;

class PresupuestoController extends Controller
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
                $presupuesto=DB::table('presupuesto as pr')
            ->join('personas as p','pr.persona_id','=','p.id')
            ->join('detalle_presupuesto as dp','pr.idpresupuesto','=','dp.idpresupuesto')
            ->select('pr.idpresupuesto','pr.fecha_hora','p.nombre','pr.tipo_comprobante','p.tipo_persona','pr.num_comprobante','pr.impuesto','pr.estado','pr.total_venta')
            ->where(function ($query) use ($quer) {
              $query->where('pr.fecha_hora','LIKE','%'.$quer.'%');
                                })
            ->whereBetween('pr.created_at',[$fe_i, $fe_f])
            ->orderBy('pr.idpresupuesto','desc')
            ->groupBy('pr.idpresupuesto','pr.fecha_hora','p.nombre','p.tipo_persona','pr.tipo_comprobante','pr.num_comprobante','pr.impuesto','pr.estado', 'pr.total_venta')
              ->paginate(7);
                   

      return view('presupuesto.index',["presupuesto"=>$presupuesto,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }

    
    public function create()
    {

     $tipofactura_list = TipoFactura::all();
     $tipopago_list = TipoPago::all(); 
     $devoluciones = Devolucion::all(); 
     $personas=Persona::all();
     $productos = DB::table('productos as prod')
        ->join('detalle_ingreso as di', 'prod.idproducto', '=', 'di.idproducto' )
            ->select(DB::raw('CONCAT(prod.barcode, " ",prod.descripcion) AS producto'),'prod.idproducto', 'prod.stock','prod.precio_venta',DB::raw('avg(di.precio_venta) as precio_promedio'))
            ->where('prod.estado','=','Activo')
            ->where('prod.stock','>','0')
            ->groupBy('producto','prod.idproducto','prod.stock','prod.precio_venta')
            ->get();
        return view("presupuesto.create",["personas"=>$personas,"productos"=>$productos,'tipofactura_list'=>$tipofactura_list,'tipopago_list'=>$tipopago_list,'devoluciones'=>$devoluciones]);
    }

     public function store (PresupuestoFormRequest $request)
    {
        //dd($request->get('idarticulo'));

        $fecha= DB::table('presupuesto')
                    ->select('presupuesto.fecha_hora')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        $mytime = Carbon::now('America/Argentina/Mendoza');
        $ventaact=$mytime->toDateString();

        $ultimoid= DB::table('presupuesto')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        $ultimodetalle= DB::table('detalle_presupuesto')
                    ->orderBy('idpresupuesto','desc')
                    ->first();
        //dd($request->get('total_venta'));
        //dd($totalpro);
    if (Presupuesto::exists()) {
        if ($ventaact == $fecha->fecha_hora) {
           $totalpro = $ultimoid->total_venta + $request->get('total_venta');
           $venta=Presupuesto::findOrFail($ultimoid->idpresupuesto);
           $venta->tipo_comprobante='Recaudacion';
           $venta->num_comprobante=000;
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
          DB::beginTransaction();
          $venta=new Presupuesto;
          $venta->persona_id=1;
          $venta->tipo_comprobante='Recaudación';
          $venta->num_comprobante=000;
          $venta->total_venta=$request->get('total_venta');
          $venta->idusuario=$request->get('idusuario');
          $venta->tipofactura_id = $request -> get('tipofactura_id');
          $venta->tipopago_id = $request -> get('tipopago_id');
          $venta->iddevolucion = $request -> get('iddevolucion');

          $mytime = Carbon::now('America/Argentina/Salta');
          $venta->fecha_hora=$mytime->toDateString();
          $venta->impuesto='21';
          $venta->estado='Efectuado';
          $venta->save();

          $idproducto = $request->get('idproducto');
          $cantidad = $request->get('cantidad');
          $descuento = $request->get('descuento');
          $precio_venta = $request->get('precio_venta');

          $cont = 0;

          while($cont < count($idproducto)){
              $detalle = new DetallePresupuesto();
              $detalle->idpresupuesto= $venta->idpresupuesto;
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
        $venta=new Presupuesto;
        $venta->persona_id=$request->get('persona_id');
        $venta->tipo_comprobante='Recaudacion';
        $venta->num_comprobante=000;
        $venta->total_venta=$request->get('total_venta');
        $venta->idusuario=$request->get('idusuario');
        $venta->tipofactura_id = $request -> get('tipofactura_id');
        $venta->tipopago_id = $request -> get('tipopago_id');
         $venta->iddevolucion = $request -> get('iddevolucion');

        $mytime = Carbon::now('America/Argentina/Salta');
        $venta->fecha_hora=$mytime->toDateString();
        $venta->impuesto='21';
        $venta->estado='Efectuado';
        $venta->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');

        $cont = 0;

        while($cont < count($idproducto)){
            $detalle = new DetallePresupuesto();
            $detalle->idpresupuesto= $venta->idpresupuesto;
            $detalle->idproducto= $idproducto[$cont];
            $detalle->cantidad= $cantidad[$cont];
            $detalle->descuento= $descuento[$cont];
            $detalle->precio_venta= $precio_venta[$cont];
            $detalle->save();
            $cont=$cont+1;
        }
        DB::commit();
      }
        return Redirect::to('presupuesto');
    }

    public function show($id)
    {
     $venta=DB::table('presupuesto as v')
            ->join('personas as p','v.persona_id','=','p.id')
            ->join('detalle_presupuesto as dv','v.idpresupuesto','=','dv.idpresupuesto')
            ->select('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
            ->groupBy('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
            ->where('v.idpresupuesto','=',$id)
            ->first();
        $detalles=DB::table('detalle_presupuesto as d')
             ->join('productos as prod','d.idproducto','=','prod.idproducto')
             ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idpresupuesto','=',$id)
             ->orderBy('created_at', 'desc')
             ->get();
        $usuario=DB::table('users')
                    ->where('id','=',$venta->idusuario)
                    ->first();
    //    dd($usuario);
        return view("presupuesto.show",["venta"=>$venta,"detalles"=>$detalles,"usuario"=>$usuario]);

    }

    public function destroy($id)
    {
       $fecha = DB::table('presupuesto')
                ->where('idpresupuesto','=',$id)
                ->first();

       $venta=Presupuesto::findOrFail($id);
       $venta->estado='Revisado';
       $venta->update();

       flash('Su recaudación del dia '.date("d-m-Y", strtotime($fecha->fecha_hora)).', fue dada como revisada ')->important();

        return Redirect::to('presupuesto');
    }

     public function pdf(Request $request,$id){
       $pre=DB::table('presupuesto as v')
             ->join('personas as p','v.persona_id','=','p.id')
             ->join('detalle_presupuesto as dv','v.idpresupuesto','=','dv.idpresupuesto')
             ->select('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.apellido')
             ->groupBy('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario','p.apellido')
             ->where('v.idpresupuesto','=',$id)
             ->first();

        $detalles=DB::table('detalle_presupuesto as d')
              ->join('productos as prod','d.idproducto','=','prod.idproducto')
              ->select('prod.descripcion as producto','d.created_at','d.cantidad','d.descuento','d.precio_venta')
              ->where('d.idpresupuesto','=',$id)
              ->get();
       $usuario=DB::table('users') 
             ->where('id','=',$pre->idusuario)
             ->first();
       $config=DB::table('config')
                ->first();

        $factura_name= sprintf('recaudacion-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('presupuesto.pdf',['pre'=>$pre,'detalles'=>$detalles,'config'=>$config,'usuario'=>$usuario]);
        return $pdf->download($factura_name);  
      }


}
