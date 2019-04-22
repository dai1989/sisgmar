<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAumentoMarcaPrecioRequest;
use App\Http\Requests\UpdateAumentoMarcaPrecioRequest;
use App\Repositories\AumentoMarcaPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash; 
use DB; 
use App\Models\Producto;
use App\Models\AumentoMarcaPrecio;
use App\Models\Marca;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
class AumentoMarcaPrecioController extends AppBaseController
{
    /** @var  AumentoMarcaPrecioRepository */
    private $aumentoMarcaPrecioRepository;

    public function __construct(AumentoMarcaPrecioRepository $aumentoMarcaPrecioRepo)
    {
        $this->aumentoMarcaPrecioRepository = $aumentoMarcaPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the AumentoMarcaPrecio.
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
               $aumentoMarcaPrecios = DB::table('aumentomarca_precio as aum') 
       
        -> join('marcas as mar','aum.marca_id','=','mar.id')
        -> join('users as u','aum.user_id','=','u.id')
        
        -> select('aum.id','aum.fecha_hora','aum.aumento','u.name','mar.marca_descripcion','aum.created_at')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('mar.marca_descripcion','LIKE','%'.$quer.'%');
                                })
                    ->whereBetween('aum.created_at',[$fe_i, $fe_f])
                     -> orderBy('aum.id', 'asc')
        -> groupBy('aum.id', 'aum.fecha_hora','aum.aumento','u.name','mar.marca_descripcion','aum.created_at')
                    ->paginate(7);

      return view('aumento_marca_precios.index',["aumentoMarcaPrecios"=>$aumentoMarcaPrecios,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }
 



    

    /**
     * Show the form for creating a new AumentoMarcaPrecio.
     *
     * @return Response
     */
    public function create()
    { 
        $productos = Producto::all();
        
        $marcas = Marca::all();
        $users = User::all();
        return view('aumento_marca_precios.create',["productos" => $productos,"users"=>$users,'marcas'=>$marcas]);
        
    }

    /**
     * Store a newly created AumentoMarcaPrecio in storage.
     *
     * @param CreateAumentoMarcaPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreateAumentoMarcaPrecioRequest $request)
    {
        $input = $request->all();

        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->create($input);

        Flash::success('Aumento Marca Precio guardado exitosamente.');

        return redirect(route('aumentoMarcaPrecios.index'));
    }

    /**
     * Display the specified AumentoMarcaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->findWithoutFail($id);

        if (empty($aumentoMarcaPrecio)) {
            Flash::error('Aumento Marca Precio no encontrado');

            return redirect(route('aumentoMarcaPrecios.index'));
        }

        return view('aumento_marca_precios.show')->with('aumentoMarcaPrecio', $aumentoMarcaPrecio);
    }

    /**
     * Show the form for editing the specified AumentoMarcaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->findWithoutFail($id);

        if (empty($aumentoMarcaPrecio)) {
            Flash::error('Aumento Marca Precio no encontrado');

            return redirect(route('aumentoMarcaPrecios.index'));
        }

        return view('aumento_marca_precios.edit')->with('aumentoMarcaPrecio', $aumentoMarcaPrecio);
    }

    /**
     * Update the specified AumentoMarcaPrecio in storage.
     *
     * @param  int              $id
     * @param UpdateAumentoMarcaPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAumentoMarcaPrecioRequest $request)
    {
        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->findWithoutFail($id);

        if (empty($aumentoMarcaPrecio)) {
            Flash::error('Aumento Marca Precio no encontrado');

            return redirect(route('aumentoMarcaPrecios.index'));
        }

        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->update($request->all(), $id);

        Flash::success('Aumento Marca Precio actualizado exitosamente.');

        return redirect(route('aumentoMarcaPrecios.index'));
    }

    /**
     * Remove the specified AumentoMarcaPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aumentoMarcaPrecio = $this->aumentoMarcaPrecioRepository->findWithoutFail($id);

        if (empty($aumentoMarcaPrecio)) {
            Flash::error('Aumento Marca Precio no encontrado');

            return redirect(route('aumentoMarcaPrecios.index'));
        }

        $this->aumentoMarcaPrecioRepository->delete($id);

        Flash::success('Aumento Marca Precio eliminado exitosamente.');

        return redirect(route('aumentoMarcaPrecios.index'));
    }
}
