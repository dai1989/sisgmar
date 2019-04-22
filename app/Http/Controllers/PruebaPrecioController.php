<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePruebaPrecioRequest;
use App\Http\Requests\UpdatePruebaPrecioRequest;
use App\Repositories\PruebaPrecioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use DB; 
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PruebaPrecioController extends AppBaseController
{
    /** @var  PruebaPrecioRepository */
    private $pruebaPrecioRepository;

    public function __construct(PruebaPrecioRepository $pruebaPrecioRepo)
    {
        $this->pruebaPrecioRepository = $pruebaPrecioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the PruebaPrecio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pruebaPrecioRepository->pushCriteria(new RequestCriteria($request));
        $pruebaPrecios = $this->pruebaPrecioRepository->all();

        return view('prueba_precios.index')
            ->with('pruebaPrecios', $pruebaPrecios);
    }

    /**
     * Show the form for creating a new PruebaPrecio.
     *
     * @return Response
     */
    public function create()
    {
         $productos = Producto::all();
        
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $users = User::all();
        return view('prueba_precios.create',["productos" => $productos,"users"=>$users,'marcas'=>$marcas,'categorias'=>$categorias]);
        
    }

    /**
     * Store a newly created PruebaPrecio in storage.
     *
     * @param CreatePruebaPrecioRequest $request
     *
     * @return Response
     */
    public function store(CreatePruebaPrecioRequest $request)
    {
        $input = $request->all();

        $pruebaPrecio = $this->pruebaPrecioRepository->create($input);

        Flash::success('Prueba Precio guardado exitosamente.');

        return redirect(route('pruebaPrecios.index'));
    }

    /**
     * Display the specified PruebaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pruebaPrecio = $this->pruebaPrecioRepository->findWithoutFail($id);

        if (empty($pruebaPrecio)) {
            Flash::error('Prueba Precio no encontrado');

            return redirect(route('pruebaPrecios.index'));
        }

        return view('prueba_precios.show')->with('pruebaPrecio', $pruebaPrecio);
    }

    /**
     * Show the form for editing the specified PruebaPrecio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pruebaPrecio = $this->pruebaPrecioRepository->findWithoutFail($id);

        if (empty($pruebaPrecio)) {
            Flash::error('Prueba Precio no encontrado');

            return redirect(route('pruebaPrecios.index'));
        }

        return view('prueba_precios.edit')->with('pruebaPrecio', $pruebaPrecio);
    }

    /**
     * Update the specified PruebaPrecio in storage.
     *
     * @param  int              $id
     * @param UpdatePruebaPrecioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePruebaPrecioRequest $request)
    {
        $pruebaPrecio = $this->pruebaPrecioRepository->findWithoutFail($id);

        if (empty($pruebaPrecio)) {
            Flash::error('Prueba Precio no encontrado');

            return redirect(route('pruebaPrecios.index'));
        }

        $pruebaPrecio = $this->pruebaPrecioRepository->update($request->all(), $id);

        Flash::success('Prueba Precio actualizado exitosamente.');

        return redirect(route('pruebaPrecios.index'));
    }

    /**
     * Remove the specified PruebaPrecio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pruebaPrecio = $this->pruebaPrecioRepository->findWithoutFail($id);

        if (empty($pruebaPrecio)) {
            Flash::error('Prueba Precio no encontrado');

            return redirect(route('pruebaPrecios.index'));
        }

        $this->pruebaPrecioRepository->delete($id);

        Flash::success('Prueba Precio eliminado exitosamente.');

        return redirect(route('pruebaPrecios.index'));
    }
}
