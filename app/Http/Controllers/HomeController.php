<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;

use App\Presupuesto;
use App\Config;
use App\EstadisticasVentas;

use  Carbon\Carbon;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
      public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }


     public function avisos()
    {
       $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

      $aviso=DB::table('productos')
                  ->orderBy('stock', 'asc')
                  ->get();
       $avisopago=DB::table('pagos')
                  ->orderBy('fecha_cobro', 'asc')
                  ->get();

      $estadistica = DB::table('estadistica_venta as es')
       ->join('productos as a','es.idproducto','=','a.idproducto')

       ->limit(7)
       ->get();
      $promedioventa = DB::table('presupuesto')
                    ->orderBy('fecha_hora', 'asc')
                    ->limit(7)
                    ->get();
        $estadisticacompra = DB::table('estadistica_compra as est')
       ->join('productos as a','est.idproducto','=','a.idproducto')
       ->limit(10)
       ->get();
      $promediocompra = DB::table('ingreso')
                    ->orderBy('fecha_hora', 'asc')
                    ->limit(7)
                    ->get();             
  $detalleingreso = DB::table('detalle_ingreso as di')
       ->join('productos as a','di.idproducto','=','a.idproducto')
       ->join('ingreso as i','di.idingreso','=','i.idingreso')
       ->limit(7)
       ->get();
      $promedioingreso = DB::table('ingreso')
                    ->orderBy('fecha_hora', 'asc')
                    ->limit(7)
                    ->get();  
       $estadisticaprecio = DB::table('estadistica_precio as esta')
       ->join('productos as a','esta.idproducto','=','a.idproducto')
       
       ->limit(10)
       ->get();

      return view('adminlte::home' ,['aviso'=>$aviso, 'estadistica'=>$estadistica, 'promedioventa'=>$promedioventa,'estadisticacompra'=>$estadisticacompra,'promediocompra'=>$promediocompra,'detalleingreso'=>$detalleingreso,'promedioingreso'=>$promedioingreso,'estadisticaprecio'=>$estadisticaprecio,'avisopago'=>$avisopago]);
    }

    
}