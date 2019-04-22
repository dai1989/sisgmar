<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDomicilioProveedorRequest;
use App\Http\Requests\UpdateDomicilioProveedorRequest;
use App\Repositories\DomicilioProveedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Proveedor;
use App\Models\TipoDomicilio;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\DomicilioProveedor;
use DB;
class DomicilioProveedorController extends AppBaseController
{
    /** @var  DomicilioProveedorRepository */
    private $domicilioProveedorRepository;

    public function __construct(DomicilioProveedorRepository $domicilioProveedorRepo)
    {
        $this->domicilioProveedorRepository = $domicilioProveedorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the DomicilioProveedor.
     *
     * @param Request $request
     * @return Response
     */
      public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener 
        $domicilioProveedors = DB::table('domicilio_proveedores as dom') 
       
        -> join('proveedores as p','dom.proveedor_id','=','p.id')
        -> join('localidad as lo','dom.localidad_id','=','lo.id')
        -> join('provincias as prov','dom.provincia_id','=','prov.id')
        
        -> select('dom.id', 'dom.calle','dom.calle_numero','dom.descripcion','p.razonsocial','p.cuit','p.condicion_iva','lo.localidad_descripcion','prov.descripcion')
        -> where('p.razonsocial','LIKE','%'.$querry.'%')        
                
        -> orderBy('dom.id', 'asc')

        -> groupBy('dom.id', 'dom.calle','dom.calle_numero','dom.descripcion','p.razonsocial','p.cuit','p.condicion_iva','lo.localidad_descripcion','prov.descripcion')
        -> paginate(7);
        
        return view('domicilio_proveedors.index', ["domicilioProveedors" => $domicilioProveedors, "searchText" => $querry]);
      }
    }

   

    /**
     * Show the form for creating a new DomicilioProveedor.
     *
     * @return Response
     */
    public function create()
    {
        $proveedor_list = Proveedor::all();
      $localidad_list = Localidad::all();
      $tipodomicilio_list = TipoDomicilio::all();
      $provincia_list = Provincia::all();
      return view("domicilio_proveedors.create", ["proveedor_list"=>$proveedor_list,"localidad_list"=>$localidad_list,"tipodomicilio_list"=>$tipodomicilio_list,"provincia_list"=>$provincia_list]);
    }

    /**
     * Store a newly created DomicilioProveedor in storage.
     *
     * @param CreateDomicilioProveedorRequest $request
     *
     * @return Response
     */
    public function store(CreateDomicilioProveedorRequest $request)
    {
        $input = $request->all();

        $domicilioProveedor = $this->domicilioProveedorRepository->create($input);

        Flash::success('Domicilio Proveedor guardado exitosamente.');

        return redirect(route('domicilioProveedors.index'));
    }

    /**
     * Display the specified DomicilioProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $domicilioProveedor = $this->domicilioProveedorRepository->findWithoutFail($id);

        if (empty($domicilioProveedor)) {
            Flash::error('Domicilio Proveedor no encontrado');

            return redirect(route('domicilioProveedors.index'));
        }

        return view('domicilio_proveedors.show')->with('domicilioProveedor', $domicilioProveedor);
    }

    /**
     * Show the form for editing the specified DomicilioProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proveedor_list = Proveedor::all();
      $localidad_list = Localidad::all();
      $tipodomicilio_list = TipoDomicilio::all();
      $provincia_list = Provincia::all();
        $domicilioProveedor =DomicilioProveedor::find($id);

       

       return view ("domicilio_proveedors.edit",["domicilioProveedor"=>$domicilioProveedor,"proveedor_list"=>$proveedor_list,'localidad_list'=>$localidad_list,'tipodomicilio_list'=>$tipodomicilio_list,'provincia_list'=>$provincia_list]);
    }

    /**
     * Update the specified DomicilioProveedor in storage.
     *
     * @param  int              $id
     * @param UpdateDomicilioProveedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDomicilioProveedorRequest $request)
    {
        $domicilioProveedor = $this->domicilioProveedorRepository->findWithoutFail($id);

        if (empty($domicilioProveedor)) {
            Flash::error('Domicilio Proveedor no encontrado');

            return redirect(route('domicilioProveedors.index'));
        }

        $domicilioProveedor = $this->domicilioProveedorRepository->update($request->all(), $id);

        Flash::success('Domicilio Proveedor actualizado exitosamente.');

        return redirect(route('domicilioProveedors.index'));
    }

    /**
     * Remove the specified DomicilioProveedor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $domicilioProveedor = $this->domicilioProveedorRepository->findWithoutFail($id);

        if (empty($domicilioProveedor)) {
            Flash::error('Domicilio Proveedor no encontrado');

            return redirect(route('domicilioProveedors.index'));
        }

        $this->domicilioProveedorRepository->delete($id);

        Flash::success('Domicilio Proveedor eliminado exitosamente.');

        return redirect(route('domicilioProveedors.index'));
    }
}
