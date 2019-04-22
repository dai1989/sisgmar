<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactoRequest;
use App\Http\Requests\UpdateContactoRequest;
use App\Repositories\ContactoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Contacto;
use App\Models\Persona;
use App\Models\TipoContacto;
use DB;
use Carbon\Carbon;
class ContactoController extends AppBaseController
{
    /** @var  ContactoRepository */
    private $contactoRepository;

    public function __construct(ContactoRepository $contactoRepo)
    {
        $this->contactoRepository = $contactoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Contacto.
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
        $contactos = DB::table('contactos as pa') 
        -> join('tipo_contactos as tc','pa.tipocontacto_id','=','tc.id')
        -> join('personas as p','pa.persona_id','=','p.id')
        
        -> select('pa.id', 'pa.contac_descripcion', 'tc.contacto_descripcion','p.nombre','p.apellido','p.documento')
        -> where('p.documento','LIKE','%'.$querry.'%')        
                
        -> orderBy('pa.id', 'asc')

        -> groupBy('pa.id', 'pa.contac_descripcion', 'tc.contacto_descripcion','p.documento','p.nombre','p.apellido')
        -> paginate(7);
        
        return view('contactos.index', ["contactos" => $contactos, "searchText" => $querry]);
      }
    }
  

    /**
     * Show the form for creating a new Contacto.
     *
     * @return Response
     */
    public function create()
    {
      $personas = Persona::all();
      $tipocontactos=TipoContacto::all(); 

      return view("contactos.create", ["personas"=>$personas,"tipocontactos"=>$tipocontactos]);
    }

    /**
     * Store a newly created Contacto in storage.
     *
     * @param CreateContactoRequest $request
     *
     * @return Response
     */
    public function store(CreateContactoRequest $request)
    {
        $input = $request->all();

        $contacto = $this->contactoRepository->create($input);

        Flash::success('Contacto guardado exitosamente.');

        return redirect(route('contactos.index'));
    }

    /**
     * Display the specified Contacto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contacto = $this->contactoRepository->findWithoutFail($id);

        if (empty($contacto)) {
            Flash::error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        return view('contactos.show')->with('contacto', $contacto);
    }

    /**
     * Show the form for editing the specified Contacto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
         $personas= Persona::all();
        $tipocontactos=TipoContacto::all();
        $contacto =Contacto::find($id);

       

       return view ("contactos.edit",["contacto"=>$contacto,"personas"=>$personas,'tipocontactos'=>$tipocontactos]);
    }

    /**
     * Update the specified Contacto in storage.
     *
     * @param  int              $id
     * @param UpdateContactoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactoRequest $request)
    {
        $contacto = $this->contactoRepository->findWithoutFail($id);

        if (empty($contacto)) {
            Flash::error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        $contacto = $this->contactoRepository->update($request->all(), $id);

        Flash::success('Contacto actualizado exitosamente.');

        return redirect(route('contactos.index'));
    }

    /**
     * Remove the specified Contacto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contacto = $this->contactoRepository->findWithoutFail($id);

        if (empty($contacto)) {
            Flash::error('Contacto no encontrado');

            return redirect(route('contactos.index'));
        }

        $this->contactoRepository->delete($id);

        Flash::success('Contacto eliminado exitosamente.');

        return redirect(route('contactos.index'));
    }
}
