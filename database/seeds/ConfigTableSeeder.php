<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('config')->delete();
        
        \DB::table('config')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'SGMAR',
                'imagen' => 'logo.jpg',
                'lema' => NULL,
                'cuit' => NULL,
                'telefono' => NULL,
                'correo' => NULL,
                'campo1' => NULL,
                'campo2' => NULL,
                'impuesto'=>'21',
                'condicion_iva'=>NULL,
           		'idusuario'=>NULL,
                'alert_minima'=>NULL,
                'alert_maxima'=>NULL,
                'estadistica_diaz'=>'7',
                'pro_vendidos'=>NULL,
                'pro_recaudacion'=>NULL,
                'menu_mini'=>NULL,
                'direccion'=>NULL,
                'producto_paginate'=>'7' ,
                'producto_orden'=>'asc',
                'categoria_paginate'=>'7',
                'categoria_orden'=>'asc',
                'cliente_paginate'=>'7',
                'cliente_orden'=>'asc',
                'proveedores_paginate'=>'7',
                'proveedores_orden'=>'asc',
                'usuario_paginate'=>'7',
                'usuario_orden'=>'asc',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            )
        ));
        
        
    }
}
