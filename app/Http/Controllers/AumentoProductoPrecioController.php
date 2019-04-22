<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAumentoProductoPrecioRequest;
use App\Http\Requests\UpdateAumentoProductoPrecioRequest;
use App\Repositories\AumentoProductoPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash; 
use DB; 
use App\Models\Producto;

use App\Models\Marca;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
class AumentoProductoPrecioController extends AppBaseController
{
    /** @var  AumentoProductoPrecioRepository */
    private $aumentoProductoPrecioRepository;

    public function __construct(AumentoProductoPrecioRepository $aumentoProductoPrecioRepo)
    {
        $this->aumentoProductoPrecioRepository = $aumentoProductoPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the AumentoProductoPrecio.
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
                $aumentoProductoPrecios = DB::table('aumentoproducto_precio as dp') 
       
        -> join('users as u','dp.user_id','=','u.id')
        -> join('productos as prod','dp.idproducto','=','prod.idproducto')
        
        -> select('dp.id','dp.fecha_hora','dp.aumento','u.name','prod.descripcion','prod.barcode','dp.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('prod.barcode','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('dp.created_at',[$fe_i, $fe_f])
                     -> orderBy('dp.id', 'asc')
       -> groupBy('dp.id', 'dp.fecha_hora','dp.aumento','u.name','prod.descripcion','prod.barcode','dp.created_at')
                    ->paginate(7);

      return view('aumento_producto_precios.index',["aumentoProductoPrecios"=>$aumentoProductoPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 



   

    /**
     * Show the form for creating a new AumentoProductoPrecio.
     *
     * @return Response
     */
    
         public function create()
    { 
        $productos = Producto::all();
        $users = User::all();
        return view('aumento_producto_precios.create',["productos" => $productos,"users"=>$users]);
        
    }
       
    

    /**
     * Store a newly created AumentoProductoPrecio in storage.
     *
     * @param CreateAumentoProductoPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateAumentoProductoPrecioRequest $request)
    {
        $input = $request->all();

        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->create($input);

        Flash::success('Aumento Producto Precio guardado exitosamente.');

        return redirect(route('aumentoProductoPrecios.index'));
    }

    /**
     * Display the specified AumentoProductoPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoProductoPrecio)) {
            Flash::error('Aumento Producto Precio no encontrado');

            return redirect(route('aumentoProductoPrecios.index'));
        }

        return view('aumento_producto_precios.show')->with('aumentoProductoPrecio', $aumentoProductoPrecio);
    }

    /**
     * Show the form for editing the specified AumentoProductoPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoProductoPrecio)) {
            Flash::error('Aumento Producto Precio no encontrado');

            return redirect(route('aumentoProductoPrecios.index'));
        }

        return view('aumento_producto_precios.edit')->with('aumentoProductoPrecio', $aumentoProductoPrecio);
    }

    /**
     * Update the specified AumentoProductoPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateAumentoProductoPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAumentoProductoPrecioRequest $request)
    {
        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoProductoPrecio)) {
            Flash::error('Aumento Producto Precio no encontrado');

            return redirect(route('aumentoProductoPrecios.index'));
        }

        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->update($request->all(), $id);

        Flash::success('Aumento Producto Precio actualizado exitosamente.');

        return redirect(route('aumentoProductoPrecios.index'));
    }

    /**
     * Remove the specified AumentoProductoPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aumentoProductoPrecio = $this->aumentoProductoPrecioRepository->findWithoutFail($id);

        if (empty($aumentoProductoPrecio)) {
            Flash::error('Aumento Producto Precio no encontrado');

            return redirect(route('aumentoProductoPrecios.index'));
        }

        $this->aumentoProductoPrecioRepository->delete($id);

        Flash::success('Aumento Producto Precio eliminado exitosamente.');

        return redirect(route('aumentoProductoPrecios.index'));
    }
}
