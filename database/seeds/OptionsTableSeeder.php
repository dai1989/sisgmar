<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('options')->delete();
        
        \DB::table('options')->insert(array (
            0 => 
            array (
                'id' => 1,
                'padre' => NULL,
                'nombre' => 'Admin',
                'ruta' => NULL,
                'descripcion' => 'Opciones de administración',
                'icono_l' => 'fa-folder',
                'icono_r' => 'fa-angle-left',
                'orden' => 0,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'padre' => 1,
                'nombre' => 'Usuarios',
                'ruta' => 'admin/users',
                'descripcion' => 'Administración de usuarios',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 2,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'padre' => 1,
                'nombre' => 'Opciones',
                'ruta' => 'admin/option',
                'descripcion' => 'Administración de las opciones del menu',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 3,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'padre' => 1,
                'nombre' => 'Roles',
                'ruta' => 'admin/roles',
                'descripcion' => 'Administración de los roles de los usuarios',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 4,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'padre' => NULL,
                'nombre' => 'Productos',
                'ruta' => 'productos',
                'descripcion' => 'Lista de productos',
                'icono_l' => 'fa fa-barcode',
                'icono_r' => 'fa-angle-left',
                'orden' => 0,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'padre' => 5,
                'nombre' => 'Categorias',
                'ruta' => 'categorias',
                'descripcion' => 'lista de categorias',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'padre' => 1,
                'nombre' => 'Configuraciones',
                'ruta' => 'config',
                'descripcion' => NULL,
                'icono_l' => 'fa fa-circle-o',
                'icono_r' => NULL,
                'orden' => 1,
                'created_at' => '2017-07-11 10:30:19',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'padre' => 5,
                'nombre' => 'Marcas',
                'ruta' => 'marcas',
                'descripcion' => 'lista de marcas',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 2,
                'created_at' => '2017-11-07 16:38:35',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'padre' => 5,
                'nombre' => 'Lista de Productos',
                'ruta' => 'productos',
                'descripcion' => NULL,
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 3,
                'created_at' => '2017-11-14 16:55:51',
                'updated_at' => '2017-11-14 16:55:51',
                'deleted_at' => NULL,
            ),
              9 => 
            array (
                'id' => 10,
                'padre' => NULL,
                'nombre' => 'Proveedores',
                'ruta' => 'proveedores',
                'descripcion' => 'Opciones de administración',
                'icono_l' => 'fa-ambulance',
                'icono_r' => 'fa-angle-left',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'padre' => 10,
                'nombre' => 'Lista Proveedores',
                'ruta' => 'proveedores',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'padre' => 10,
                'nombre' => 'Contacto',
                'ruta' => 'contactoProveedors',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'padre' => 10,
                'nombre' => 'Domicilio',
                'ruta' => 'domicilioProveedors',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 2,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

            13 => 
            array (
                'id' => 14,
                'padre' => NULL,
                'nombre' => 'Clientes',
                'ruta' => 'clientes',
                'descripcion' => 'Opciones de administración',
                'icono_l' => 'fa-folder',
                'icono_r' => 'fa-angle-left',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             14 => 
            array (
                'id' => 15,
                'padre' => 14,
                'nombre' => 'Lista de clientes',
                'ruta' => 'clientes',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             15 => 
            array (
                'id' => 16,
                'padre' => 14,
                'nombre' => 'Contacto',
                'ruta' => 'contactos',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 2,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

            16 => 
            array (
                'id' => 17,
                'padre' => 14,
                'nombre' => 'Domicilio',
                'ruta' => 'domicilios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 3,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             17 => 
            array (
                'id' => 18,
                'padre' => NULL,
                'nombre' => 'Compras',
                'ruta' => 'ingreso',
                'descripcion' => '',
                'icono_l' => 'fa fa-shopping-cart',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             18 => 
            array (
                'id' => 19,
                'padre' => NULL,
                'nombre' => 'Ventas',
                'ruta' => 'venta',
                'descripcion' => '',
                'icono_l' => 'fa fa-money',
                'icono_r' => 'fa-angle-left',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             19 => 
            array (
                'id' => 20,
                'padre' => 19,
                'nombre' => 'Cuenta Corriente',
                'ruta' => 'mensual',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

              20 => 
            array (
                'id' => 21,
                'padre' => 19,
                'nombre' => 'Recaudacion por ventas',
                'ruta' => 'presupuesto',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 2,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

               21 => 
            array (
                'id' => 22,
                'padre' => 19,
                'nombre' => 'Pagos de Cta Cte',
                'ruta' => 'mensualpago-inicio',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 3,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

               22 => 
            array (
                'id' => 23,
                'padre' => 19,
                'nombre' => 'Devoluciones',
                'ruta' => 'devolucion-inicio',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 4,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             23 => 
            array (
                'id' => 24,
                'padre' => NULL,
                'nombre' => 'Presupuestos',
                'ruta' => 'estimacion',
                'descripcion' => '',
                'icono_l' => 'fa fa-calculator',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             24 => 
            array (
                'id' => 25,
                'padre' => NULL,
                'nombre' => 'Graficos',
                'ruta' => 'listado_graficas',
                'descripcion' => '',
                'icono_l' => 'fa fa-bar-chart',
                'icono_r' => 'fa fa-angle-left pull-right',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),


             25 => 
            array (
                'id' => 26,
                'padre' => 25,
                'nombre' => 'Ventas',
                'ruta' => 'listado_graficas',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             26 => 
            array (
                'id' => 27,
                'padre' => 25,
                'nombre' => 'Compras',
                'ruta' => 'listado_compras',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),


             27 => 
            array (
                'id' => 28,
                'padre' => NULL,
                'nombre' => 'Config de Precios',
                'ruta' => 'aumentoPrecios',
                'descripcion' => '',
                'icono_l' => 'fa fa-laptop',
                'icono_r' => 'fa fa-angle-left pull-right',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             28 => 
            array (
                'id' => 29,
                'padre' => 28,
                'nombre' => 'Aumento de Precio',
                'ruta' => 'aumentoPrecios',
                'descripcion' => '',
                'icono_l' => 'fa fa-asterisk',
                'icono_r' => 'fa fa-angle-right pull-right',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             29 => 
            array (
                'id' => 30,
                'padre' => 29,
                'nombre' => 'Por categoria',
                'ruta' => 'aumentoPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             30 => 
            array (
                'id' => 31,
                'padre' => 29,
                'nombre' => 'Por producto',
                'ruta' => 'aumentoProductoPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             31 => 
            array (
                'id' => 32,
                'padre' => 29,
                'nombre' => 'Por marca',
                'ruta' => 'aumentoMarcaPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

             32 => 
            array (
                'id' => 33,
                'padre' => 28,
                'nombre' => 'Disminucion de Precio',
                'ruta' => 'disminucionPrecios',
                'descripcion' => '',
                'icono_l' => 'fa fa-asterisk',
                'icono_r' => 'fa fa-angle-right pull-right',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             33 => 
            array (
                'id' => 34,
                'padre' => 33,
                'nombre' => 'Por producto',
                'ruta' => 'disminucionPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             34 => 
            array (
                'id' => 35,
                'padre' => 33,
                'nombre' => 'Por categoria',
                'ruta' => 'disminucionCategoriaPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'padre' => 33,
                'nombre' => 'Por marca',
                'ruta' => 'disminucionMarcaPrecios',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             36 => 
            array (
                'id' => 37,
                'padre' => 28,
                'nombre' => 'Variacion precio venta',
                'ruta' => 'estadisticaPrecios',
                'descripcion' => '',
                'icono_l' => 'fa fa-area-chart',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),

            37 => 
            array (
                'id' => 38,
                'padre' => NULL,
                'nombre' => 'Control de stock',
                'ruta' => 'almacen/productos/stock',
                'descripcion' => '',
                'icono_l' => 'fa fa-info-circle',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             38 => 
            array (
                'id' => 39,
                'padre' => 5,
                'nombre' => 'Otras Salidas',
                'ruta' => 'devolucionproducto',
                'descripcion' => 'otras salidas',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 1,
                'created_at' => '2017-07-09 10:35:37',
                'updated_at' => '2017-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
              39 => 
            array (
                'id' => 40,
                'padre' => 19,
                'nombre' => 'Ventas',
                'ruta' => 'venta',
                'descripcion' => '',
                'icono_l' => 'fa-circle-o',
                'icono_r' => '',
                'orden' => 5,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             40 => 
            array (
                'id' => 41,
                'padre' => NULL,
                'nombre' => 'Control de pagos al proveedor',
                'ruta' => 'pagos',
                'descripcion' => '',
                'icono_l' => 'fa fa-info-circle',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),
             41 => 
            array (
                'id' => 42,
                'padre' => NULL,
                'nombre' => 'Ayuda',
                'ruta' => 'manual',
                'descripcion' => '',
                'icono_l' => 'fa fa-info-circle',
                'icono_r' => '',
                'orden' => 0,
                'created_at' => '2018-07-09 10:35:37',
                'updated_at' => '2018-11-07 16:42:44',
                'deleted_at' => NULL,
            ),


        ));
        
        
    }
}