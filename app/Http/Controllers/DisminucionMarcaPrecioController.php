<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisminucionMarcaPrecioRequest;
use App\Http\Requests\UpdateDisminucionMarcaPrecioRequest;
use App\Repositories\DisminucionMarcaPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Models\Producto;
use App\Models\Marca;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
use DB;
class DisminucionMarcaPrecioController extends AppBaseController
{
    /** @var  DisminucionMarcaPrecioRepository */
    private $disminucionMarcaPrecioRepository;

    public function __construct(DisminucionMarcaPrecioRepository $disminucionMarcaPrecioRepo)
    {
        $this->disminucionMarcaPrecioRepository = $disminucionMarcaPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the DisminucionMarcaPrecio.
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
               $disminucionMarcaPrecios = DB::table('disminucionmarca_precio as aum') 
       
        -> join('marcas as mar','aum.marca_id','=','mar.id')
        -> join('users as u','aum.user_id','=','u.id')
        
        -> select('aum.id','aum.fecha_hora','aum.disminucion','u.name','mar.marca_descripcion','aum.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('mar.marca_descripcion','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('aum.created_at',[$fe_i, $fe_f])
                     -> orderBy('aum.id', 'asc')
        -> groupBy('aum.id', 'aum.fecha_hora','aum.disminucion','u.name','mar.marca_descripcion','aum.created_at')
                    ->paginate(7);

      return view('disminucion_marca_precios.index',["disminucionMarcaPrecios"=>$disminucionMarcaPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 



   

    /**
     * Show the form for creating a new DisminucionMarcaPrecio.
     *
     * @return Response
     */
    public function create()
    {
         $marcas = Marca::all();
        $users = User::all();
        return view('disminucion_marca_precios.create',["marcas" => $marcas,"users"=>$users]);
        
    }

    /**
     * Store a newly created DisminucionMarcaPrecio in storage.
     *
     * @param CreateDisminucionMarcaPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateDisminucionMarcaPrecioRequest $request)
    {
        $input = $request->all();

        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->create($input);

        Flash::success('Disminucion Marca Precio guardado exitosamente.');

        return redirect(route('disminucionMarcaPrecios.index'));
    }

    /**
     * Display the specified DisminucionMarcaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionMarcaPrecio)) {
            Flash::error('Disminucion Marca Precio no encontrado');

            return redirect(route('disminucionMarcaPrecios.index'));
        }

        return view('disminucion_marca_precios.show')->with('disminucionMarcaPrecio', $disminucionMarcaPrecio);
    }

    /**
     * Show the form for editing the specified DisminucionMarcaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionMarcaPrecio)) {
            Flash::error('Disminucion Marca Precio no encontrado');

            return redirect(route('disminucionMarcaPrecios.index'));
        }

        return view('disminucion_marca_precios.edit')->with('disminucionMarcaPrecio', $disminucionMarcaPrecio);
    }

    /**
     * Update the specified DisminucionMarcaPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateDisminucionMarcaPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDisminucionMarcaPrecioRequest $request)
    {
        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionMarcaPrecio)) {
            Flash::error('Disminucion Marca Precio no encontrado');

            return redirect(route('disminucionMarcaPrecios.index'));
        }

        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->update($request->all(), $id);

        Flash::success('Disminucion Marca Precio actualizado exitosamente.');

        return redirect(route('disminucionMarcaPrecios.index'));
    }

    /**
     * Remove the specified DisminucionMarcaPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $disminucionMarcaPrecio = $this->disminucionMarcaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionMarcaPrecio)) {
            Flash::error('Disminucion Marca Precio no encontrado');

            return redirect(route('disminucionMarcaPrecios.index'));
        }

        $this->disminucionMarcaPrecioRepository->delete($id);

        Flash::success('Disminucion Marca Precio eliminado exitosamente.');

        return redirect(route('disminucionMarcaPrecios.index'));
    }
}
