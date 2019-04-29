<?php

namespace App\Http\Controllers;

use App\Arqueo;
use App\ArqueoDetalle;
use App\ArqueoPago;
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
                        <a href="' . route('arqueo.pago.show', $ar->idarqueo) . '" class="btn btn-success"><i class="fa fa-money"></i> Pagos</a>
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

        return view('arqueo.show', compact('arqueo', 'efectivo', 'id', 'corriente', 'ingreso', 'inicio'));
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
        $mytime = Carbon::now('America/Argentina/Salta');

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

        $pago = New ArqueoPago();
        $pago->idarqueo = $arqueo->idarqueo;
        $pago->idventa = 0;
        $pago->tipo_pago = 'Inicio';
        $pago->pago_efectivo = $request->cantidad;
        $pago->pago_debito = 0;
        $pago->pago_credito = 0;
        $pago->monto = $request->cantidad;
        $pago->save();

        flash('Su día ha iniciado perfectamente')->success()->important();
        return Redirect::back();

    }

    public function storeshow(Request $request)
    {
        if ($request->tipo_pago == 'Efectivo'){
            $arqueo = Arqueo::find($request->idarqueo);
            $arqueo->total_dia =  $arqueo->total_dia + $request->monto;
            $arqueo->save();
        }
        else
        {
            $arqueo = Arqueo::find($request->idarqueo);
            $arqueo->total_dia =  $arqueo->total_dia - $request->monto;
            $arqueo->save();
        }


        $detalle = New ArqueoDetalle();
        $detalle->idarqueo = $request->idarqueo ;
        $detalle->cantidad = 1 ;
        $detalle->monto = $request->monto ;
        $detalle->total = $request->monto * 1 ;
        $detalle->tipo_venta = $request->tipo_pago;
        $detalle->tipo_pago = $request->tipo_pago;
        $detalle->descripcion = $request->descripcion;
        $detalle->save();

        $pago = New ArqueoPago();
        $pago->idarqueo =  $request->idarqueo;
        $pago->idventa = 0;
        $pago->tipo_pago = $request->tipo_pago;
        $pago->pago_efectivo = $request->monto;
        $pago->pago_debito = 0;
        $pago->pago_credito = 0;
        $pago->monto = $request->monto;
        $pago->save();

        flash('Su detalle se agrego correctamente')->success()->important();

        return Redirect::back();
    }

    public function pagos($id)
    {
        $arqueo = Arqueo::with('pago')->where('idarqueo', $id)->first();

        $arqueode = ArqueoPago::where('idarqueo', $id)->where('tipo_pago','<>', 'Ingreso')->get();
        $ingreso = ArqueoPago::where('idarqueo', $id)->where('tipo_pago','=', 'Ingreso')->get();

        return view('arqueo.pago' , compact('arqueo','arqueode', 'id', 'ingreso'));
    }

    public function tablapago($id)
    {
        $arqueo = ArqueoPago::where('idarqueo', $id)->orderBy('idarqueo_pago', 'desc')->get();

        return Datatables::of($arqueo)

            ->addColumn('opcion', function ($ar) {

                if ($ar->idventa != 0)
                {
                    return '<a href="' . route('venta.show', $ar->idventa) . '" class="btn btn-info"><i class="fa fa-money"></i> Venta</a>';
                }
                elseif ($ar->idingreso != 0)
                {
                    return '<a href="' . route('ingreso.show', $ar->idingreso) . '" class="btn btn-info"><i class="fa fa-money"></i> Venta</a>';
                }
                else{
                    return 'No existe detalle';
                }
            })
            ->editColumn('hora', function ($fe) {
                return date("H:i:s", strtotime($fe->created_at));
            })
            ->rawColumns(['opcion'])
            ->make(true);
    }
}
