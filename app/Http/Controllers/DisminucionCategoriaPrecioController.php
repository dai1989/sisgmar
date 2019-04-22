<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDisminucionCategoriaPrecioRequest;
use App\Http\Requests\UpdateDisminucionCategoriaPrecioRequest;
use App\Repositories\DisminucionCategoriaPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Flash;
use DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DisminucionCategoriaPrecioController extends AppBaseController
{
    /** @var  DisminucionCategoriaPrecioRepository */
    private $disminucionCategoriaPrecioRepository;

    public function __construct(DisminucionCategoriaPrecioRepository $disminucionCategoriaPrecioRepo)
    {
        $this->disminucionCategoriaPrecioRepository = $disminucionCategoriaPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the DisminucionCategoriaPrecio.
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
               $disminucionCategoriaPrecios = DB::table('disminucioncategoria_precio as aum') 
       
        -> join('categorias as mar','aum.categoria_id','=','mar.id')
        -> join('users as u','aum.user_id','=','u.id')
        
        -> select('aum.id','aum.fecha_hora','aum.disminucion','u.name','mar.categoria_descripcion','aum.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('mar.categoria_descripcion','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('aum.created_at',[$fe_i, $fe_f])
                     -> orderBy('aum.id', 'asc')
        -> groupBy('aum.id', 'aum.fecha_hora','aum.disminucion','u.name','mar.categoria_descripcion','aum.created_at')
                    ->paginate(7);

      return view('disminucion_categoria_precios.index',["disminucionCategoriaPrecios"=>$disminucionCategoriaPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 



   
    /**
     * Show the form for creating a new DisminucionCategoriaPrecio.
     *
     * @return Response
     */
    public function create()
    {
         $categorias = Categoria::all();
        $users = User::all();
        return view('disminucion_categoria_precios.create',["categorias" => $categorias,"users"=>$users]);
        
    }

    /**
     * Store a newly created DisminucionCategoriaPrecio in storage.
     *
     * @param CreateDisminucionCategoriaPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateDisminucionCategoriaPrecioRequest $request)
    {
        $input = $request->all();

        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->create($input);

        Flash::success('Disminucion Categoria Precio guardado exitosamente.');

        return redirect(route('disminucionCategoriaPrecios.index'));
    }

    /**
     * Display the specified DisminucionCategoriaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionCategoriaPrecio)) {
            Flash::error('Disminucion Categoria Precio no encontrado');

            return redirect(route('disminucionCategoriaPrecios.index'));
        }

        return view('disminucion_categoria_precios.show')->with('disminucionCategoriaPrecio', $disminucionCategoriaPrecio);
    }

    /**
     * Show the form for editing the specified DisminucionCategoriaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionCategoriaPrecio)) {
            Flash::error('Disminucion Categoria Precio no encontrado');

            return redirect(route('disminucionCategoriaPrecios.index'));
        }

        return view('disminucion_categoria_precios.edit')->with('disminucionCategoriaPrecio', $disminucionCategoriaPrecio);
    }

    /**
     * Update the specified DisminucionCategoriaPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateDisminucionCategoriaPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDisminucionCategoriaPrecioRequest $request)
    {
        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionCategoriaPrecio)) {
            Flash::error('Disminucion Categoria Precio no encontrado');

            return redirect(route('disminucionCategoriaPrecios.index'));
        }

        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->update($request->all(), $id);

        Flash::success('Disminucion Categoria Precio actualizado exitosamente.');

        return redirect(route('disminucionCategoriaPrecios.index'));
    }

    /**
     * Remove the specified DisminucionCategoriaPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $disminucionCategoriaPrecio = $this->disminucionCategoriaPrecioRepository->findWithoutFail($id);

        if (empty($disminucionCategoriaPrecio)) {
            Flash::error('Disminucion Categoria Precio no encontrado');

            return redirect(route('disminucionCategoriaPrecios.index'));
        }

        $this->disminucionCategoriaPrecioRepository->delete($id);

        Flash::success('Disminucion Categoria Precio eliminado exitosamente.');

        return redirect(route('disminucionCategoriaPrecios.index'));
    }
}
