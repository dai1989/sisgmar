<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstadisticaPrecioRequest;
use App\Http\Requests\UpdateEstadisticaPrecioRequest;
use App\Repositories\EstadisticaPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;

class EstadisticaPrecioController extends AppBaseController
{
    /** @var  EstadisticaPrecioRepository */
    private $estadisticaPrecioRepository;

    public function __construct(EstadisticaPrecioRepository $estadisticaPrecioRepo)
    {
        $this->estadisticaPrecioRepository = $estadisticaPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the EstadisticaPrecio.
     *
     * @param Request $request
     * @return Response
     */
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
               $estadisticaPrecios = DB::table('estadistica_precio as est') 
        -> join('productos as prod','est.idproducto','=','prod.idproducto')
        -> join('categorias as cate','est.categoria_id','=','cate.id')
        -> join('marcas as m','est.marca_id','=','m.id')
        
        
        -> select('est.id', 'est.idproducto','est.precio_venta', 'prod.descripcion','est.precio_anterior','prod.barcode','est.fecha_hora','cate.categoria_descripcion','m.marca_descripcion')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('prod.barcode','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('est.fecha_hora',[$fe_i, $fe_f])
                     ->orderBy('est.id','desc')
                     -> groupBy('est.id','est.idproducto', 'est.precio_venta', 'prod.descripcion','est.precio_anterior','prod.barcode','est.fecha_hora','cate.categoria_descripcion','m.marca_descripcion')
                    ->paginate(7);

      return view('estadistica_precios.index',["estadisticaPrecios"=>$estadisticaPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
    

    /**
     * Show the form for creating a new EstadisticaPrecio.
     *
     * @return Response
     */
    public function create()
    {
        return view('estadistica_precios.create');
    }

    /**
     * Store a newly created EstadisticaPrecio in storage.
     *
     * @param CreateEstadisticaPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateEstadisticaPrecioRequest $request)
    {
        $input = $request->all();

        $estadisticaPrecio = $this->estadisticaPrecioRepository->create($input);

        Flash::success('Estadistica Precio guardado exitosamente.');

        return redirect(route('estadisticaPrecios.index'));
    }

    /**
     * Display the specified EstadisticaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estadisticaPrecio = $this->estadisticaPrecioRepository->findWithoutFail($id);

        if (empty($estadisticaPrecio)) {
            Flash::error('Estadistica Precio no encontrado');

            return redirect(route('estadisticaPrecios.index'));
        }

        return view('estadistica_precios.show')->with('estadisticaPrecio', $estadisticaPrecio);
    }

    /**
     * Show the form for editing the specified EstadisticaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estadisticaPrecio = $this->estadisticaPrecioRepository->findWithoutFail($id);

        if (empty($estadisticaPrecio)) {
            Flash::error('Estadistica Precio no encontrado');

            return redirect(route('estadisticaPrecios.index'));
        }

        return view('estadistica_precios.edit')->with('estadisticaPrecio', $estadisticaPrecio);
    }

    /**
     * Update the specified EstadisticaPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateEstadisticaPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstadisticaPrecioRequest $request)
    {
        $estadisticaPrecio = $this->estadisticaPrecioRepository->findWithoutFail($id);

        if (empty($estadisticaPrecio)) {
            Flash::error('Estadistica Precio no encontrado');

            return redirect(route('estadisticaPrecios.index'));
        }

        $estadisticaPrecio = $this->estadisticaPrecioRepository->update($request->all(), $id);

        Flash::success('Estadistica Precio actualizado exitosamente.');

        return redirect(route('estadisticaPrecios.index'));
    }

    /**
     * Remove the specified EstadisticaPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estadisticaPrecio = $this->estadisticaPrecioRepository->findWithoutFail($id);

        if (empty($estadisticaPrecio)) {
            Flash::error('Estadistica Precio no encontrado');

            return redirect(route('estadisticaPrecios.index'));
        }

        $this->estadisticaPrecioRepository->delete($id);

        Flash::success('Estadistica Precio eliminado exitosamente.');

        return redirect(route('estadisticaPrecios.index'));
    }
}
