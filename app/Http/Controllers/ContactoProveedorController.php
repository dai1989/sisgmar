<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactoProveedorRequest;
use App\Http\Requests\UpdateContactoProveedorRequest;
use App\Repositories\ContactoProveedorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\ContactoProveedor;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\TipoContacto;
use DB;
class ContactoProveedorController extends AppBaseController
{
    /** @var  ContactoProveedorRepository */
    private $contactoProveedorRepository;

    public function __construct(ContactoProveedorRepository $contactoProveedorRepo)
    {
        $this->contactoProveedorRepository = $contactoProveedorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the ContactoProveedor.
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
        $contactoProveedors = DB::table('contacto_proveedores as pa') 
        -> join('tipo_contactos as tc','pa.tipocontacto_id','=','tc.id')
        -> join('proveedores as p','pa.proveedor_id','=','p.id')
        
        -> select('pa.id', 'pa.contac_descripcion', 'tc.contacto_descripcion','p.razonsocial','p.cuit','p.condicion_iva')
        -> where('p.razonsocial','LIKE','%'.$querry.'%')        
                
        -> orderBy('pa.id', 'asc')

        -> groupBy('pa.id', 'pa.contac_descripcion', 'tc.contacto_descripcion','p.condicion_iva','p.razonsocial','p.cuit')
        -> paginate(7);
        
        return view('contacto_proveedors.index', ["contactoProveedors" => $contactoProveedors, "searchText" => $querry]);
      }
    }
   

    /**
     * Show the form for creating a new ContactoProveedor.
     *
     * @return Response
     */
    public function create()
    {
         $proveedores = Proveedor::all();
         $tipocontactos=TipoContacto::all(); 

      return view("contacto_proveedors.create", ["proveedores"=>$proveedores,"tipocontactos"=>$tipocontactos]);
    }

    /**
     * Store a newly created ContactoProveedor in storage.
     *
     * @param CreateContactoProveedorRequest $request
     *
     * @return Response
     */
    public function store(CreateContactoProveedorRequest $request)
    {
        $input = $request->all();

        $contactoProveedor = $this->contactoProveedorRepository->create($input);

        Flash::success('Contacto Proveedor guardado exitosamente.');

        return redirect(route('contactoProveedors.index'));
    }

    /**
     * Display the specified ContactoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contactoProveedors.index'));
        }

        return view('contacto_proveedors.show')->with('contactoProveedor', $contactoProveedor);
    }

    /**
     * Show the form for editing the specified ContactoProveedor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proveedores= Proveedor::all();
        $tipocontactos=TipoContacto::all();
        $contactoProveedor =ContactoProveedor::find($id);

       

       return view ("contacto_proveedors.edit",["contactoProveedor"=>$contactoProveedor,"proveedores"=>$proveedores,'tipocontactos'=>$tipocontactos]);
    }

    /**
     * Update the specified ContactoProveedor in storage.
     *
     * @param  int              $id
     * @param UpdateContactoProveedorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactoProveedorRequest $request)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contactoProveedors.index'));
        }

        $contactoProveedor = $this->contactoProveedorRepository->update($request->all(), $id);

        Flash::success('Contacto Proveedor actualizado exitosamente.');

        return redirect(route('contactoProveedors.index'));
    }

    /**
     * Remove the specified ContactoProveedor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contactoProveedor = $this->contactoProveedorRepository->findWithoutFail($id);

        if (empty($contactoProveedor)) {
            Flash::error('Contacto Proveedor no encontrado');

            return redirect(route('contactoProveedors.index'));
        }

        $this->contactoProveedorRepository->delete($id);

        Flash::success('Contacto Proveedor eliminado exitosamente.');

        return redirect(route('contactoProveedors.index'));
    }
}
