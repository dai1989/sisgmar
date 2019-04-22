<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Http\Requests\CreateProductoRequest;

use App\Config;

use DB;

class ConfigController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }
     public function index()
     {
       $config=DB::table('config')
                   ->first();
       return view('config.index',['config'=>$config]);
     }

     public function create(Request $request)
     {
      //  dd($request);

       function stripAccents($string){
         return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝñÑ',
         'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYnN');
         }

       $config= new Config;
       $config->nombre=$request->get('nombre');
       $config->lema=$request->get('lema');
       if (Input::hasFile('imagen')) {
       $file = Input::file('imagen');
       $file->move(public_path().'/imagenes/config/', stripAccents($file->getClientOriginalName()));
        $config->imagen=$file->getClientOriginalName();
       }
       $config->cuit=$request->get('cuit');
       $config->condicion_iva=$request->get('condicion_iva');
       $config->telefono=$request->get('telefono');
       $config->correo=$request->get('correo');
       $config->campo1=$request->get('pagina');
      //  $config->campo2=$request->get('nombre');
       $config->impuesto=$request->get('impuesto');
       $config->direccion=$request->get('direccion');
       $config->idusuario=$request->get('idusuario');
       $config->alert_minima=$request->get('alert_minima');
       $config->alert_maxima=$request->get('alert_maxima');
       $config->estadistica_diaz=$request->get('estadistica_diaz');
       $config->pro_vendidos=$request->get('pro_vendidos');
       $config->pro_recaudacion=$request->get('pro_recaudacion');
       $config->menu_mini=$request->get('menu_mini');
       $config->direccion=$request->get('direccion');
       $config->save();

       $config=DB::table('config')
                   ->first();
       return view('config.index',['config'=>$config]);
     }

     public function edit($id)
     {
         return view("config.edit", ["config" => Config::findOrFail($id)]);
     }
     public function update(Request $request, $id)
     {
        // dd($request);
         $config=Config::findOrFail($id);
         $config->nombre=$request->get('nombre');
         $config->lema=$request->get('lema');
         $config->cuit=$request->get('cuit');
         $config->condicion_iva=$request->get('condicion_iva');
         $config->telefono=$request->get('telefono');
         $config->correo=$request->get('correo');
         $config->campo2=$request->get('pagina');
         $config->impuesto=$request->get('impuesto');
         $config->direccion=$request->get('direccion');
         $config->alert_minima=$request->get('alert_minima');
         $config->alert_maxima=$request->get('alert_maxima');
         $config->estadistica_diaz=$request->get('estadistica_diaz');
         $config->pro_vendidos=$request->get('pro_vendidos');
         $config->pro_recaudacion=$request->get('pro_recaudacion');
         $config->menu_mini=$request->get('menu_mini');
         $config->producto_paginate = $request->get('producto_paginate');
         $config->producto_orden = $request->get('producto_orden');
         $config->categoria_paginate = $request->get('categoria_paginate');
         $config->categoria_orden = $request->get('categoria_orden');
         $config->cliente_paginate = $request->get('cliente_paginate');
         $config->cliente_orden = $request->get('cliente_orden');
         $config->proveedores_paginate = $request->get('proveedores_paginate');
         $config->proveedores_orden = $request->get('proveedores_orden');
         $config->usuario_paginate = $request->get('usuario_paginate');
         $config->usuario_orden = $request->get('usuario_orden');


         $config->campo1=$request->get('campo1');
         if (Input::hasFile('imagen')) {
          $file = Input::file('imagen');
          $file->move(public_path().'/imagenes/config/', $file->getClientOriginalName());
          $config->imagen=$file->getClientOriginalName();
         }
         $config->update();
         flash('Configuración fue editada correcatamente')->success()->important();
         return Redirect::to('config');
     }
     public function diccionario()
     {
       return view("manual.diccionariodatos");
     }

     public function manual()
     {
       return view("manual.manual");
     }
     public function plantilla()
     {
       return view("plantilla");
     }

     public function presentacion()
     {
       return view("manual.yo");
     }


}
