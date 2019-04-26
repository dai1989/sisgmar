<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductoDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateProductoRequest;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use DetalleIngreso;
use Flash;
use App\Config;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DNS1D;
class ProductoController extends Controller
{
    

  //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }
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
                $productos = DB::table('productos as prod') 
                -> join('categorias as c', 'prod.categoria_id', '=', 'c.id')
                -> join('marcas as m', 'prod.marca_id', '=', 'm.id')
                -> select('prod.created_at','prod.idproducto', 'prod.descripcion', 'prod.barcode', 'prod.stock', 'prod.precio_venta','prod.precio_compra','c.categoria_descripcion as categoria','m.marca_descripcion as marca','prod.descripcion', 'prod.imagen', 'prod.estado')
                   
                    ->where(function ($query) use ($quer) {
                        $query->where('prod.barcode','LIKE','%'.$quer.'%');
                                })
                    
                    ->whereBetween('prod.created_at',[$fe_i, $fe_f])
                     ->orderBy('prod.idproducto','desc')
                    
                    ->paginate(7);

      return view('productos.index',["productos"=>$productos,"searchText"=>$quer,"fin"=>$fin, "inicio"=>$inicio]);

    }

  }


    
   


    //create (mostra la vista de crear)
    public function create()
    {
      $categorias = Categoria::all();
      $marcas = Marca::all();
     
      
      return view('productos.create', ["categorias" => $categorias,"marcas"=>$marcas]);
    }

    //show (mostrar la vista de show)
    public function show($id)
   {
    

    $articulodetallei = DB::table('detalle_ingreso as ingreso')
    ->where('ingreso.idproducto', $id)
    ->get();
    $articulodetallev = DB::table('detalle_venta as venta')
    ->where('venta.idproducto', $id)
    ->get();
    $articulodetallem = DB::table('detalle_mensual as mensual')
    ->where('mensual.idproducto', $id)
    ->get();
    $todo= collect([$articulodetallei,$articulodetallev,$articulodetallem])->collapse();
    $todo2= $todo->sortBy(function($ordenar){
      return $ordenar->created_at;
    });
    $producto=Producto::findOrFail($id);
     $devo = DB::table('detalle_devoproductos')->get();
    //  dd($articulo->nombre);
    return view("productos.show", ["todo2" => $todo2,"producto" => $producto,"devo"=>$devo]);
  }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {

      $producto = Producto::findOrFail($id);
      $categorias = Categoria::all();
      $marcas = Marca::all();


      return view ('productos.edit', ['producto' => $producto, 'categorias' => $categorias,'marcas'=>$marcas]);
    }

    //store(insertar un registro)
    public function store(CreateProductoRequest $request)
    {
      //creamos un objeto del tipo categoria
      $producto = new Producto;
      $producto -> categoria_id = $request -> get('categoria_id');//este valor es el que se encuentra en el formulario
      $producto -> marca_id = $request -> get('marca_id');//este valor es el que se encuentra en el formulario
      $producto -> barcode = $request -> get('barcode');
      $producto -> descripcion = $request -> get('descripcion');
      
      $producto -> stock = $request -> get('stock');
      $producto -> precio_venta = $request -> get('precio_venta');
      $producto -> precio_compra = $request -> get('precio_compra');
      
      $producto -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $producto -> imagen = $file -> getClientOriginalName();
      }

      $producto -> save();
      Flash::success('Producto guardado exitosamente.');

      return Redirect::to('productos');
    }

    //update (actualizar un registro)
    public function update(Request $request, $id)
    {
    
      $producto = Producto::findOrFail($id);
      $producto -> categoria_id = $request -> get('categoria_id');//este valor es el que se encuentra en el formulario
      $producto -> marca_id = $request -> get('marca_id');//este valor es el que se encuentra en el formulario
      $producto -> barcode = $request -> get('barcode');
      $producto -> descripcion = $request -> get('descripcion');
      $producto -> stock = $request -> get('stock');
      $producto -> precio_venta = $request -> get('precio_venta');
      $producto -> precio_compra = $request -> get('precio_compra');
      
      $producto -> estado = 'Activo';

      //revisar si hay imagen y subirla al server
      if(Input::hasFile('imagen'))
      {
        $file = Input::file('imagen');
        $file -> move(public_path().'/imagenes/productos', $file -> getClientOriginalName());
        $producto -> imagen = $file -> getClientOriginalName();
      }
      $producto -> update(); 

      return Redirect::to('productos');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $producto = Producto::findOrFail($id);
      $producto -> estado = 'Inactivo';
      $producto -> update();

      return Redirect::to('productos');
    }

     

    public function pdf(Request $request,$id){
         $productos = Producto::join('categorias','productos.categoria_id','=','categorias.id')
        
        ->select('productos.idproducto',
        'productos.descripcion','productos.barcode','productos.stock','productos.imagen','productos.estado','categorias.categoria_descripcion')
        ->where('productos.idproducto','=',$id)
        ->orderBy('productos.idproducto','desc')->take(1)->get();

       

        $producto_name= sprintf('productos-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('productos.pdf',['productos'=>$productos,]);
        return $pdf->download($producto_name);  
      }

       public function stock()
  {
    $cate = Config::all()->first();
    //  dd($cate->articulo_paginate);
      if ($cate->producto_orden == 'asc') {
        $productos=DB::table('productos as prod')
        ->join('categorias as c', 'prod.categoria_id', '=' ,'c.id')
        -> join('marcas as m', 'prod.marca_id', '=', 'm.id')
        ->select('prod.idproducto', 'prod.descripcion', 'prod.barcode', 'prod.stock', 'c.categoria_descripcion as categoria', 'prod.descripcion', 'prod.imagen', 'prod.estado','prod.precio_venta','prod.precio_compra','m.marca_descripcion as marca')
        ->orderBy('prod.idproducto', 'asc')
        ->get();
      }
      else {
        $productos=DB::table('producto as prod')
        ->join('categorias as c', 'prod.categoria_id', '=' ,'c.id')
        -> join('marcas as m', 'prod.marca_id', '=', 'm.id')
        ->select('prod.idproducto', 'prod.descripcion', 'prod.barcode', 'prod.stock', 'c.categoria_descripcion as categoria', 'prod.descripcion', 'prod.imagen', 'prod.estado','prod.precio_venta','prod.precio_compra','m.marca_descripcion as marca')
        ->orderBy('prod.idproducto', 'desc' )
        ->get();
      }
      return view("almacen.productos.stock", ["productos" => $productos]);

    }
     public function listarPdf(Request $request,$id){
          $productos = Producto::join('categorias','productos.categoria_id','=','categorias.id')
        
        ->select('productos.idproducto',
        'productos.descripcion','productos.barcode','productos.stock','productos.imagen','productos.estado','categorias.categoria_descripcion')
        ->orderBy('productos.idproducto', 'desc')->get();
        $cont=Producto::count();
       

        $producto_name= sprintf('productos-%s.pdf', str_pad (strval($id),5, '0', STR_PAD_LEFT));

        $pdf = PDF::loadView('pdf.articulospdf',['productos'=>$productos,'cont'=>$cont]);
        return $pdf->download($producto_name);  
      }

}
