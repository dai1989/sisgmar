<?php

namespace App\Http\Controllers;

use App\Arqueo;
use App\ArqueoDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ArqueController extends Controller
{
    public function index()
    {
        $arqueo = Arqueo::all();
        return view('arqueo.index', compact('arqueo'));
    }

    public function tabla()
    {
        $arqueo = Arqueo::all();

        return Datatables::of($arqueo)
            ->addColumn('opcion', function ($ar) {
                return '<a href="' . route('arqueo.show', $ar->idarqueo) . '" class="btn btn-info"><i class="fa fa-history"></i> Detalle</a>
                        <a  href="#" data-toggle="modal" data-target="#modal_cerrar-' . $ar->idarqueo . '"class="btn btn-danger"><i class="fa fa-trash"></i> Cerrar día</a>
                       ';
            })
            ->editColumn('fecha_hora', function ($fe) {
                return date("d-m-Y", strtotime($fe->fecha_hora));
            })
            ->rawColumns(['opcion'])
            ->make(true);
    }

   public function show($id)
    {
        $arqueo = Arqueo::with('detalle')->where('idarqueo', $id)->first();

        $efectivo = ArqueoDetalle::where('idarqueo', $id)->where('tipo_pago', 'Efectivo')->get();
        $corriente = ArqueoDetalle::where('idarqueo', $id)->where('tipo_pago', 'Corriente')->get();
        $ingreso = ArqueoDetalle::where('idarqueo', $id)->where('tipo_pago', 'Ingreso')->get();
        $inicio = ArqueoDetalle::where('idarqueo', $id)->where('tipo_pago', 'Inicio')->first();
         $pagado = ArqueoDetalle::where('idarqueo', $id)->where('tipo_pago', 'Entrega')->first();

        return view('arqueo.show', compact('arqueo', 'efectivo', 'id', 'corriente', 'ingreso', 'inicio', 'pagado'));
    }

    public function tablashow($id)
    {
        $arqueo = ArqueoDetalle::where('idarqueo', $id)->orderBy('idarqueo_detalle', 'desc')->get();

        return Datatables::of($arqueo)
            ->editColumn('hora', function ($fe) {
                return date("H:i:s", strtotime($fe->created_at));
            })
            ->make(true);
    }

    public function update($id)
    {


        $co = Arqueo::find($id);
        $co->estado = 'Cerrado';
        $co->save();

        flash('Su Arqueo se cerro correctamente')->error()->important();
        return Redirect::back();

    }

    public function store(Request $request)
    {
        $arquo = Arqueo::where('estado', 'Abierto')->first();

        if ($arquo != null)
        {
            flash('Debe cerrar el arqueo anterior')->error()->important();
            return Redirect::back();
        }
        $mytime = Carbon::now('America/Argentina/Mendoza');

        $arqueo = New Arqueo();
        $arqueo->fecha_hora =  $mytime->toDateTimeString();
        $arqueo->estado = 'Abierto';
        $arqueo->total_dia = $request->cantidad;
        $arqueo->save();

        $det = New ArqueoDetalle();
        $det->idarqueo = $arqueo->idarqueo;
        $det->cantidad = 1;
        $det->monto = $request->cantidad;
        $det->total = $request->cantidad;
        $det->tipo_venta = 'Inicio';
        $det->tipo_pago = 'Inicio';
        $det->save();

        flash('Su día ha iniciado perfectamente')->success()->important();
        return Redirect::back();

    }
     public function storeshow(Request $request)
    {
        $detalle = New ArqueoDetalle();
        $detalle->idarqueo = $request->idarqueo ;
        $detalle->cantidad = 1 ;
        $detalle->monto = $request->monto ;
        $detalle->total = $request->monto * 1 ;
        $detalle->tipo_venta = $request->tipo_pago;
        $detalle->tipo_pago = $request->tipo_pago;
        $detalle->descripcion = $request->descripcion;
        $detalle->save();

        flash('Su detalle se agrego correctamente')->success()->important();

        return Redirect::back();
    }
}
