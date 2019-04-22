<?php

namespace App\Http\Controllers;

use App\Mensual;
use App\MensualPago;
use App\Arqueo;
use App\ArqueoDetalle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;
class MensualPagoController extends Controller
{
    public function pago(Request $request)
    {

        $mytime = Carbon::now('America/Argentina/Salta');

         $arqueo = Arqueo::where('estado', 'Abierto')->first();

        $ar = Arqueo::find($arqueo->idarqueo);
        $ar->total_dia = $arqueo->total_dia +  $request->monto;
        $ar->save();

        $arde = New ArqueoDetalle();
        $arde->idarqueo = $arqueo->idarqueo;
        $arde->monto= $request->monto;
        $arde->cantidad= 1;
        $arde->tipo_venta= 'Corriente';
        $arde->tipo_pago= 'Entrega';
        $arde->descripcion= 'Se Entrego Dinero';
        $arde->total= $request->monto;
        $arde->save();
        $pago = new MensualPago();
        $pago->idmensual = $request->idmensual;
        $pago->monto = $request->monto;
        
        $pago->fecha_hora=$mytime->toDateTimeString();
        $pago->save();

        flash('El monto de entrega se ha agregado correctamente')->success()->important();
        return Redirect::back();

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
            $mensualpago=DB::table('mensual_pago as d')
     ->join('mensual as men','d.idmensual','=','men.idmensual')
                ->join('personas as p','men.persona_id','=','p.id')
     
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('d.fecha_hora','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('d.created_at',[$fe_i, $fe_f])
                    ->orderBy('d.idmensual_pago','desc')
     
                    ->paginate(7);
                    

      return view('mensualpago.inicio',["mensualpago"=>$mensualpago,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }


   
    public function show($id)
    {
//        dd($id);
        $mensualpago=DB::table('mensual_pago as d')
             ->join('mensual as men','d.idmensual','=','men.idmensual')
            ->join('personas as p','men.persona_id','=','p.id')
            ->where('d.idmensual_pago','=',$id)
            ->first();
       
           

        return view('mensualpago.show',compact('mensualpago'));
    }

   

    public function pdf(Request $request,$id){
        
       $devolucion=DB::table('devolucions as d')
            ->join('personas as p','d.idcliente','=','p.id')
            ->where('d.iddevolucion','=',$id)
            ->first();
        //dd($venta);
        $detalles=DB::table('devolucion_detalles as dd')
            ->join('productos as a','dd.idproducto','=','a.idproducto')
            ->where('dd.iddevolucion','=',$id)
             ->where('dd.cantidad','>','0')
            ->select('dd.*', 'a.descripcion')
            ->get();
       

       

        $factura_name= sprintf('devolucions-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('devolucion.pdf',['devolucion'=>$devolucion,'detalles'=>$detalles]);
        return $pdf->download($factura_name);  
      }


}
