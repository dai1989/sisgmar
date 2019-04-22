<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisminucionPrecioRequest;
use App\Http\Requests\UpdateDisminucionPrecioRequest;
use App\Repositories\DisminucionPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\User;
use Flash;
use DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
class DisminucionPrecioController extends AppBaseController
{
    /** @var  DisminucionPrecioRepository */
    private $disminucionPrecioRepository;

    public function __construct(DisminucionPrecioRepository $disminucionPrecioRepo)
    {
        $this->disminucionPrecioRepository = $disminucionPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the DisminucionPrecio.
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
                $disminucionPrecios = DB::table('disminucion_precio as dp') 
        -> join('productos as prod','dp.idproducto','=','prod.idproducto')
        -> join('users as u','dp.user_id','=','u.id')
        
        -> select('dp.id', 'dp.fecha_hora', 'prod.descripcion','dp.disminucion','u.name','prod.barcode','prod.precio_venta','dp.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('prod.barcode','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('dp.created_at',[$fe_i, $fe_f])
                     -> orderBy('dp.id', 'asc')
       -> groupBy('dp.id', 'dp.fecha_hora', 'prod.descripcion','dp.disminucion','u.name','prod.barcode','prod.precio_venta','dp.created_at')
                    ->paginate(7);

      return view('disminucion_precios.index',["disminucionPrecios"=>$disminucionPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 


  


    /**
     * Show the form for creating a new DisminucionPrecio.
     *
     * @return Response
     */
    public function create()
    {
        $productos = Producto::all();
        $users = User::all();
        return view('disminucion_precios.create',["productos" => $productos,"users"=>$users]);
    }

    /**
     * Store a newly created DisminucionPrecio in storage.
     *
     * @param CreateDisminucionPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateDisminucionPrecioRequest $request)
    {
        $input = $request->all();

        $disminucionPrecio = $this->disminucionPrecioRepository->create($input);

        Flash::success('Disminucion Precio guardado exitosamente.');

        return redirect(route('disminucionPrecios.index'));
    }

    /**
     * Display the specified DisminucionPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $disminucionPrecio = $this->disminucionPrecioRepository->findWithoutFail($id);

        if (empty($disminucionPrecio)) {
            Flash::error('Disminucion Precio no encontrado');

            return redirect(route('disminucionPrecios.index'));
        }

        return view('disminucion_precios.show')->with('disminucionPrecio', $disminucionPrecio);
    }

    /**
     * Show the form for editing the specified DisminucionPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $disminucionPrecio = $this->disminucionPrecioRepository->findWithoutFail($id);

        if (empty($disminucionPrecio)) {
            Flash::error('Disminucion Precio no encontrado');

            return redirect(route('disminucionPrecios.index'));
        }

        return view('disminucion_precios.edit')->with('disminucionPrecio', $disminucionPrecio);
    }

    /**
     * Update the specified DisminucionPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateDisminucionPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDisminucionPrecioRequest $request)
    {
        $disminucionPrecio = $this->disminucionPrecioRepository->findWithoutFail($id);

        if (empty($disminucionPrecio)) {
            Flash::error('Disminucion Precio no encontrado');

            return redirect(route('disminucionPrecios.index'));
        }

        $disminucionPrecio = $this->disminucionPrecioRepository->update($request->all(), $id);

        Flash::success('Disminucion Precio actualizado exitosamente.');

        return redirect(route('disminucionPrecios.index'));
    }

    /**
     * Remove the specified DisminucionPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $disminucionPrecio = $this->disminucionPrecioRepository->findWithoutFail($id);

        if (empty($disminucionPrecio)) {
            Flash::error('Disminucion Precio no encontrado');

            return redirect(route('disminucionPrecios.index'));
        }

        $this->disminucionPrecioRepository->delete($id);

        Flash::success('Disminucion Precio eliminado exitosamente.');

        return redirect(route('disminucionPrecios.index'));
    }
}
