<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\PersonaFormRequest;
use App\DataTables\PersonaDataTable;
use App\Models\Cliente;
use App\Persona;

use DB;

use App\Config;

class ClienteController extends Controller
{
  public function __construct()
  {
    $this -> middleware('auth');
  }
   public function index(PersonaDataTable $personaDataTable)
    {
        return $personaDataTable->render('clientes.index');
    }
  public function create()
  {
    return view("clientes.create");
  }
  public function store(PersonaFormRequest $request)
  {
    $persona=new Persona;
    $persona->tipo_persona=$request->get('tipo_persona');
    $persona->condicion_iva=$request->get('condicion_iva');
    $persona->nombre=$request->get('nombre');
    $persona->apellido=$request->get('apellido');
    $persona->tipo_documento=$request->get('tipo_documento');
    $persona->documento=$request->get('documento');
    $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    $persona->genero=$request->get('genero');
    
    $persona->save();
     $cliente = new Cliente (); 
      $cliente->persona_id= $persona->id;
      $cliente->save();
    $per = Persona::all()->last();
    flash('Su cliente '.$per->nombre.' ha sido creado correctamente')->important();
    return Redirect::to('clientes');
  }
  public function show($id)
  {
    return view("clientes.show", ["persona" => Persona::findOrFail($id)]);
  }
  public function edit($id)
  {
    return view("clientes.edit", ["persona" => Persona::findOrFail($id)]);
  }
  public function update(PersonaFormRequest $request, $id)
  {
    // dd($request);
    $persona=Persona::findOrFail($id);
    $persona->nombre=$request->get('nombre');
    $persona->apellido=$request->get('apellido');
    $persona->tipo_documento=$request->get('tipo_documento');
    $persona->documento=$request->get('documento');
    $persona->tipo_persona= $request->get('tipo_persona');
    $persona->condicion_iva= $request->get('condicion_iva');
    $persona->genero=$request->get('genero');
    $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    
    $persona->update();
    $per = Persona::findOrFail($id);
    flash('Su cliente '.$per->nombre.' ha sido modificado correctamente')->success()->important();
    return Redirect::to('clientes');
  }
  public function destroy($id)
  {
    $persona=Persona::findOrFail($id);
    $persona->tipo_persona='Inactivo';
    $persona->update();
    $per = Persona::findOrFail($id);
    flash('Su cliente '.$per->nombre.' ha sido borrado correctamente')->error()->important();
    return Redirect::to('clientes');
  }
}
