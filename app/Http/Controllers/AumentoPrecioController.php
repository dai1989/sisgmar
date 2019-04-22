<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAumentoPrecioRequest;
use App\Http\Requests\UpdateAumentoPrecioRequest;
use App\Repositories\AumentoPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\AumentoPrecio;
use App\Models\Categoria;
use App\User;
use Flash;
use DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
class AumentoPrecioController extends AppBaseController
{
    /** @var  AumentoPrecioRepository */
    private $aumentoPrecioRepository;

    public function __construct(AumentoPrecioRepository $aumentoPrecioRepo)
    {
        $this->aumentoPrecioRepository = $aumentoPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the AumentoPrecio.
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
               $aumentoPrecios = DB::table('aumento_precio as dp') 
       
        -> join('categorias as cate','dp.categoria_id','=','cate.id')
        -> join('users as u','dp.user_id','=','u.id')
        
        -> select('dp.id','dp.fecha_hora','dp.aumento','u.name','cate.categoria_descripcion','dp.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('cate.categoria_descripcion','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('dp.created_at',[$fe_i, $fe_f])
                     ->orderBy('dp.id','desc')
                     -> groupBy('dp.id', 'dp.fecha_hora','dp.aumento','u.name','cate.categoria_descripcion','dp.created_at')
                    ->paginate(7);

      return view('aumento_precios.index',["aumentoPrecios"=>$aumentoPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 

    /**
     * Show the form for creating a new AumentoPrecio.
     *
     * @return Response
     */
     public function create()
    {
       $productos = Producto::all();
        
        $categorias = Categoria::all();
        $users = User::all();
        return view('aumento_precios.create',["productos" => $productos,"users"=>$users,'categorias'=>$categorias]);
    }
       
    /**
     * Store a newly created AumentoPrecio in storage.
     *
     * @param CreateAumentoPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateAumentoPrecioRequest $request)
    {
        $input = $request->all();

        $aumentoPrecio = $this->aumentoPrecioRepository->create($input);

        Flash::success('Aumento Precio guardado exitosamente.');

        return redirect(route('aumentoPrecios.index'));
    }

    /**
     * Display the specified AumentoPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aumentoPrecio = $this->aumentoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoPrecio)) {
            Flash::error('Aumento Precio no encontrado');

            return redirect(route('aumentoPrecios.index'));
        }

        return view('aumento_precios.show')->with('aumentoPrecio', $aumentoPrecio);
    }

    /**
     * Show the form for editing the specified AumentoPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aumentoPrecio = $this->aumentoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoPrecio)) {
            Flash::error('Aumento Precio no encontrado');

            return redirect(route('aumentoPrecios.index'));
        }

        return view('aumento_precios.edit')->with('aumentoPrecio', $aumentoPrecio);
    }

    /**
     * Update the specified AumentoPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateAumentoPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAumentoPrecioRequest $request)
    {
        $aumentoPrecio = $this->aumentoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoPrecio)) {
            Flash::error('Aumento Precio no encontrado');

            return redirect(route('aumentoPrecios.index'));
        }

        $aumentoPrecio = $this->aumentoPrecioRepository->update($request->all(), $id);

        Flash::success('Aumento Precio actualizado exitosamente.');

        return redirect(route('aumentoPrecios.index'));
    }

    /**
     * Remove the specified AumentoPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aumentoPrecio = $this->aumentoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoPrecio)) {
            Flash::error('Aumento Precio no encontrado');

            return redirect(route('aumentoPrecios.index'));
        }

        $this->aumentoPrecioRepository->delete($id);

        Flash::success('Aumento Precio eliminado exitosamente.');

        return redirect(route('aumentoPrecios.index'));
    }
}
