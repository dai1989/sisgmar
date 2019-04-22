<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Categoria;
use App\Models\Marca;

use App\Http\Requests;

use Illuminate\Http\Collection;
//use Barryvdh\DomPDF\Facade as PDF;

use DB;
class PDFController extends Controller
{
    public function __construct()
    {
      parent::__construct();
    }
    public function categoria()
    {
        $categoria = Categoria::All();

        view()->share('categoria',$categoria);

        $pdf = \PDF::loadView('pdf.categoria');

        return $pdf->download('Todas las Categorias.pdf');

    }

    public function presupuesto($id)
    {
        $pre=DB::table('presupuesto as v')
             ->join('personas as p','v.idcliente','=','p.id')
             ->join('detalle_presupuesto as dv','v.idpresupuesto','=','dv.idpresupuesto')
             ->select('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
             ->groupBy('v.idpresupuesto','v.fecha_hora','p.nombre','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
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
         $pdf = \PDF::loadView('pdf.presupuesto' , array('pre'=>$pre, 'config'=>$config, 'detalles'=>$detalles ,'usuario'=> $usuario));

         return $pdf->stream('Detalle De la Recaudación Diaria:'.$pre->fecha_hora.'.pdf');

      //  return $pdf->download('Todas las Categorias.pdf');
    }

    public function estimacion($id)
    {
        $estimacion=DB::table('estimacion as e')
        ->join('detalle_estimacion as de','e.idestimacion','=','de.idestimacion')
        ->select('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
        ->groupBy('e.idestimacion','e.fecha_hora','e.impuesto','e.estado','e.total_venta','e.idusuario')
        ->where('e.idestimacion','=',$id)
        ->first();
        //dd($estimacion);
        $detalles=DB::table('detalle_estimacion as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.created_at','d.cantidad','d.descuento','d.precio_venta')
        ->where('d.idestimacion','=',$id)
        ->get();
        // dd($detalles);
        $usuario=DB::table('users')
        ->where('id','=',$estimacion->idusuario)
        ->first();
         $config=DB::table('config')
                     ->first();
         $pdf = \PDF::loadView('pdf.estimacion' , array('estimacion'=>$estimacion, 'config'=>$config, 'detalles'=>$detalles ,'usuario'=> $usuario));

         return $pdf->stream('Detalle Del Presupuesto:'.$estimacion->fecha_hora.'.pdf');

      //  return $pdf->download('Todas las Categorias.pdf');
    }


    public function mensual($id)
    {
      $mensual=DB::table('mensual as v')
          ->join('persona as p','v.idcliente','=','p.idpersona')
          ->join('detalle_mensual as dv','v.idmensual','=','dv.idmensual')
          ->select('v.idmensual','v.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
          ->groupBy('v.idmensual','v.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
          ->where('v.idmensual','=',$id)
          ->first();
          //dd($venta);
      $detalles=DB::table('detalle_mensual as d')
           ->join('articulo as a','d.idarticulo','=','a.idarticulo')
           ->select('a.nombre as articulo','d.created_at','d.cantidad','d.descuento','d.precio_venta')
           ->where('d.idmensual','=',$id)
           ->get();
       $usuario=DB::table('users') 
             ->where('id','=',$mensual->idusuario)
             ->first();
       $config=DB::table('config')
                ->first();
       $pdf = \PDF::loadView('pdf.mensual' , array('mensual'=>$mensual, 'detalles'=>$detalles ,'usuario'=> $usuario,'config'=> $config));

       return $pdf->stream('Presupuesto:'.$mensual->nombre.'.pdf');
    }

    public function venta($id)
    {
        $venta=DB::table('venta as v')
             ->join('persona as p','v.idcliente','=','p.idpersona')
             ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
             ->select('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
             ->groupBy('v.idventa','v.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','v.tipo_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','idusuario')
             ->where('v.idventa','=',$id)
             ->first();
             //dd($venta);
         $detalles=DB::table('detalle_venta as d')
              ->join('articulo as a','d.idarticulo','=','a.idarticulo')
              ->select('a.nombre as articulo','d.created_at','d.cantidad','d.descuento','d.precio_venta')
              ->where('d.idventa','=',$id)
              ->get();
          $config=DB::table('config')
                  ->first();
          $usuario=DB::table('users')
                ->where('id','=',$venta->idusuario)
                ->first();
          $pdf = \PDF::loadView('pdf.venta' , array('venta'=>$venta, 'detalles'=>$detalles ,'usuario'=> $usuario ,'config'=> $config));

          return $pdf->stream('Venta:'.$venta->nombre.'.pdf');

    }

    public function ingreso($id)
    {
      $ingreso=DB::table('ingreso as i')
      ->join('persona as p','i.idproveedor','=','p.idpersona')
      ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
      ->select('i.idingreso','i.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
      ->groupBy('i.idingreso','i.fecha_hora','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','i.tipo_comprobante','i.num_comprobante','i.impuesto','i.estado')
      ->where('i.idingreso','=',$id)
      ->first();

      $detalles=DB::table('detalle_ingreso as d')
      ->join('articulo as a','d.idarticulo','=','a.idarticulo')
      ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta','d.created_at')
      ->where('d.idingreso','=',$id)
      ->get();
      $config=DB::table('config')
              ->first();
      $pdf = \PDF::loadView('pdf.ingreso' , array('ingreso'=>$ingreso, 'detalles'=>$detalles ,'config'=> $config));

      return $pdf->stream('Ingreso:'.$ingreso->nombre.'.pdf');
    }

    public function codigoarticulo(Request $request)
    {
      $productos=DB::table('productos as prod')
        ->join('categorias as c', 'prod.categoria_id', '=' ,'c.id')
        ->select('prod.idproducto', 'prod.descripcion', 'prod.barcode', 'prod.stock', 'c.categoria_descripcion as categoria', 'prod.descripcion', 'prod.imagen', 'prod.estado')
        ->whereIn('idproducto', $request->barcode)
        ->get();
        //  dd($articulos);

         $pdf = \PDF::loadView('pdf.pdfcodigo' , array('productos'=>$productos));

         return $pdf->stream('Productos.pdf');
    }
     public function show($id)
    {
        //
    }

}

