<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDomicilioRequest;
use App\Http\Requests\UpdateDomicilioRequest;
use App\Repositories\DomicilioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Persona;
use App\Models\TipoDomicilio;
use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\Domicilio;
use DB;
class DomicilioController extends AppBaseController
{
    /** @var  DomicilioRepository */
    private $domicilioRepository;

    public function __construct(DomicilioRepository $domicilioRepo)
    {
        $this->domicilioRepository = $domicilioRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Domicilio.
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
        $domicilios = DB::table('domicilios as dom') 
        -> join('tipo_domicilios as td','dom.tipodomicilio_id','=','td.id')
        -> join('personas as p','dom.persona_id','=','p.id')
        -> join('localidad as lo','dom.localidad_id','=','lo.id')
        -> join('provincias as prov','dom.provincia_id','=','prov.id')
        
        -> select('dom.id', 'dom.calle','dom.calle_numero','dom.descripcion','td.tipo_descripcion','p.nombre','p.apellido','p.documento','lo.localidad_descripcion','prov.descripcion')
        -> where('p.documento','LIKE','%'.$querry.'%')        
                
        -> orderBy('dom.id', 'asc')

        -> groupBy('dom.id', 'dom.calle','dom.calle_numero','dom.descripcion','td.tipo_descripcion','p.nombre','p.apellido','p.documento','lo.localidad_descripcion','prov.descripcion')
        -> paginate(7);
        
        return view('domicilios.index', ["domicilios" => $domicilios, "searchText" => $querry]);
      }
    }

    /**
     * Show the form for creating a new Domicilio.
     *
     * @return Response
     */
    public function create()
    {
        $persona_list = Persona::all();
      $localidad_list = Localidad::all();
      $tipodomicilio_list = TipoDomicilio::all();
      $provincia_list = Provincia::all();
      return view("domicilios.create", ["persona_list"=>$persona_list,"localidad_list"=>$localidad_list,"tipodomicilio_list"=>$tipodomicilio_list,"provincia_list"=>$provincia_list]);
    }

    /**
     * Store a newly created Domicilio in storage.
     *
     * @param CreateDomicilioRequest $request
     *
     * @return Response
     */
    public function store(CreateDomicilioRequest $request)
    {
        $input = $request->all();

        $domicilio = $this->domicilioRepository->create($input);

        Flash::success('Domicilio guardado exitosamente.');

        return redirect(route('domicilios.index'));
    }

    /**
     * Display the specified Domicilio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $domicilio = $this->domicilioRepository->findWithoutFail($id);

        if (empty($domicilio)) {
            Flash::error('Domicilio no encontrado');

            return redirect(route('domicilios.index'));
        }

        return view('domicilios.show')->with('domicilio', $domicilio);
    }

    /**
     * Show the form for editing the specified Domicilio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        

        $persona_list = Persona::all();
      $localidad_list = Localidad::all();
      $tipodomicilio_list = TipoDomicilio::all();
      $provincia_list = Provincia::all();
        $domicilio =Domicilio::find($id);

       

       return view ("domicilios.edit",["domicilio"=>$domicilio,"persona_list"=>$persona_list,'localidad_list'=>$localidad_list,'tipodomicilio_list'=>$tipodomicilio_list,'provincia_list'=>$provincia_list]);
    }

    /**
     * Update the specified Domicilio in storage.
     *
     * @param  int              $id
     * @param UpdateDomicilioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDomicilioRequest $request)
    {
        $domicilio = $this->domicilioRepository->findWithoutFail($id);

        if (empty($domicilio)) {
            Flash::error('Domicilio no encontrado');

            return redirect(route('domicilios.index'));
        }

        $domicilio = $this->domicilioRepository->update($request->all(), $id);

        Flash::success('Domicilio actualizado exitosamente.');

        return redirect(route('domicilios.index'));
    }

    /**
     * Remove the specified Domicilio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $domicilio = $this->domicilioRepository->findWithoutFail($id);

        if (empty($domicilio)) {
            Flash::error('Domicilio no encontrado');

            return redirect(route('domicilios.index'));
        }

        $this->domicilioRepository->delete($id);

        Flash::success('Domicilio eliminado exitosamente.');

        return redirect(route('domicilios.index'));
    }
}
