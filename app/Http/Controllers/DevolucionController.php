<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Devolucion;
use App\DevolucionDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
class DevolucionController extends Controller
{
    public function devolucion(Request $request)
    {
//        dd($request->all());

        $vali = DB::table('devolucions')->where('num_factura', $request->num_factura)->first();

        if ($vali != null)
        {
            flash('Ya Existe una devolución')->error()->important();
            return Redirect::route('devolucion.show',$vali->iddevolucion );
        }

        $deco= new Devolucion();
        $deco->num_factura =$request->num_factura;
        $deco->idcliente=$request->idcliente;
        $mytime = Carbon::now('America/Argentina/Salta');
        $deco->fecha_devolucion=$mytime->toDateTimeString();
        $deco->num_comprobante=$request->num_comprobante;
        $deco->total_venta=$request->total_venta;
        $deco->save();

        $idproducto = $request->get('idproducto');
        $cantidad = $request->get('cantidad');
        $precio_venta = $request->get('precio_venta');
        $sube_resta = $request->get('suma_resta');
        $observacion = $request->get('observacion');

        $cont = 0;

        while($cont < count($idproducto)){
            $detalle = new DevolucionDetalle();
            $detalle->iddevolucion= $deco->iddevolucion;
            $detalle->idproducto= $idproducto[$cont]; 
            if ($sube_resta[$cont] == 'sumar')
            {
                $prod = Producto::find($idproducto[$cont]);
                $prod->stock = $prod->stock + $cantidad[$cont];
                $prod->save();
            }
            $detalle->cantidad= $cantidad[$cont];
            $detalle->precio_venta= $precio_venta[$cont];
            $detalle->observacion= $observacion[$cont];
            $detalle->sube_resta= $sube_resta[$cont];
            $detalle->save();
            $cont=$cont+1;
        }

        flash('Su devolución se genero correctamente')->important();
        return Redirect::route('devolucion.show',$deco->iddevolucion );
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
              $devolucion=DB::table('devolucions as d')
                ->join('personas as p','d.idcliente','=','p.id')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('d.num_factura','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('d.created_at',[$fe_i, $fe_f])
                     -> orderBy('d.iddevolucion', 'asc')
       
                    ->paginate(7);

      return view('devolucion.inicio',["devolucion"=>$devolucion,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 




  
    public function show($id)
    {
//        dd($id);
        $devolucion=DB::table('devolucions as d')
            ->join('personas as p','d.idcliente','=','p.id')
            ->where('d.iddevolucion','=',$id)
            ->first();
        //dd($venta);
        $detalles=DB::table('devolucion_detalles as dd')
            ->join('productos as a','dd.idproducto','=','a.idproducto')
            ->where('dd.cantidad','>','0')

            ->where('dd.iddevolucion','=',$id)
            ->select('dd.*', 'a.descripcion','a.barcode')
            ->get();
//        dd($detalles);

        return view('devolucion.show',compact('detalles', 'devolucion'));
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
