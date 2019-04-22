<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Productos
        Permission::create([
            'name'          => 'Navegar productos',
            'slug'          => 'productos.index',
            'description'   => 'Lista y navega todos los productos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un producto',
            'slug'          => 'productos.show',
            'description'   => 'Ve en detalle cada producto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de productos',
            'slug'          => 'productos.create',
            'description'   => 'Podría crear nuevos productos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de productos',
            'slug'          => 'productos.edit',
            'description'   => 'Podría editar cualquier dato de un producto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar productos',
            'slug'          => 'productos.destroy',
            'description'   => 'Podría eliminar cualquier producto del sistema',      
        ]);

         //Categorias
        Permission::create([
            'name'          => 'Navegar categorias',
            'slug'          => 'categorias.index',
            'description'   => 'Lista y navega todas las categorias del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una categoria',
            'slug'          => 'categorias.show',
            'description'   => 'Ve en detalle cada categoria del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de categoria',
            'slug'          => 'categorias.create',
            'description'   => 'Podría crear nuevas categorias en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de categorias',
            'slug'          => 'categorias.edit',
            'description'   => 'Podría editar cualquier dato de una categoria del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar categorias',
            'slug'          => 'categorias.destroy',
            'description'   => 'Podría eliminar cualquier categoria del sistema',      
        ]);

         //Marcas
        Permission::create([
            'name'          => 'Navegar marcas',
            'slug'          => 'marcas.index',
            'description'   => 'Lista y navega todos los marcas del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una marca',
            'slug'          => 'marcas.show',
            'description'   => 'Ve en detalle cada marca del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de marca',
            'slug'          => 'marcas.create',
            'description'   => 'Podría crear nuevas marcas en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de marcas',
            'slug'          => 'marcas.edit',
            'description'   => 'Podría editar cualquier dato de una marca del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar marcas',
            'slug'          => 'marcas.destroy',
            'description'   => 'Podría eliminar cualquier marca del sistema',      
        ]);

        //Clientes
        Permission::create([
            'name'          => 'Navegar clientes',
            'slug'          => 'clientes.index',
            'description'   => 'Lista y navega todos los clientes del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una cliente',
            'slug'          => 'clientes.show',
            'description'   => 'Ve en detalle cada cliente del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de cliente',
            'slug'          => 'clientes.create',
            'description'   => 'Podría crear nuevas clientes en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de clientes',
            'slug'          => 'clientes.edit',
            'description'   => 'Podría editar cualquier dato de una cliente del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar clientes',
            'slug'          => 'clientes.destroy',
            'description'   => 'Podría eliminar cualquier cliente del sistema',      
        ]);

          //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',      
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',      
        ]);

         //CONTACTOS
        Permission::create([
            'name'          => 'Navegar contactos',
            'slug'          => 'contactos.index',
            'description'   => 'Lista y navega todos los contactos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una contacto',
            'slug'          => 'contactos.show',
            'description'   => 'Ve en detalle cada contacto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de contacto',
            'slug'          => 'contactos.create',
            'description'   => 'Podría crear nuevos contactos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de contactos',
            'slug'          => 'contactos.edit',
            'description'   => 'Podría editar cualquier dato de un contacto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar contactos',
            'slug'          => 'contactos.destroy',
            'description'   => 'Podría eliminar cualquier contacto del sistema',     
        ]);

        //CONTACTO PROVEEDOR
        Permission::create([
            'name'          => 'Navegar contacto de los proveedores',
            'slug'          => 'contactoProveedors.index',
            'description'   => 'Lista y navega todos los contacto de los proveedores del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un contacto del proveedor',
            'slug'          => 'contactoProveedors.show',
            'description'   => 'Ve en detalle cada contacto del proveedor del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de contacto proveedor',
            'slug'          => 'contactoProveedors.create',
            'description'   => 'Podría crear nuevos contactos de los proveedores en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de contacto de los proveedores',
            'slug'          => 'contactoProveedors.edit',
            'description'   => 'Podría editar cualquier dato de un contacto del proveedor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar contacto de los proveedores',
            'slug'          => 'contactoProveedors.destroy',
            'description'   => 'Podría eliminar cualquier contacto provedor del sistema',     
        ]);

         //PROVEEDOR.
        Permission::create([
            'name'          => 'Navegar proveedores',
            'slug'          => 'proveedores.index',
            'description'   => 'Lista y navega todos los proveedores del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un proveedor',
            'slug'          => 'proveedores.show',
            'description'   => 'Ve en detalle cada proveedor del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de proveedor',
            'slug'          => 'proveedores.create',
            'description'   => 'Podría crear nuevos proveedores en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de proveedores',
            'slug'          => 'proveedores.edit',
            'description'   => 'Podría editar cualquier dato de un proveedor del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar proveedores',
            'slug'          => 'proveedores.destroy',
            'description'   => 'Podría eliminar cualquier proveedor del sistema',     
        ]);

        //VENTA.
        Permission::create([
            'name'          => 'Navegar venta',
            'slug'          => 'venta.index',
            'description'   => 'Lista y navega todas las venta del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una venta',
            'slug'          => 'venta.show',
            'description'   => 'Ve en detalle cada venta del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de venta',
            'slug'          => 'venta.create',
            'description'   => 'Podría crear nuevas venta en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de venta',
            'slug'          => 'venta.edit',
            'description'   => 'Podría editar cualquier dato de una venta del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar venta',
            'slug'          => 'venta.destroy',
            'description'   => 'Podría eliminar cualquier venta del sistema',     
        ]);

            //Ingreso.
        Permission::create([
            'name'          => 'Navegar compras',
            'slug'          => 'ingreso.index',
            'description'   => 'Lista y navega todas las compras del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una compra',
            'slug'          => 'ingreso.show',
            'description'   => 'Ve en detalle cada compra del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de compra',
            'slug'          => 'ingreso.create',
            'description'   => 'Podría crear nuevas compras en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de ingreso',
            'slug'          => 'ingreso.edit',
            'description'   => 'Podría editar cualquier dato de una compra del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar ingreso',
            'slug'          => 'ingreso.destroy',
            'description'   => 'Podría eliminar cualquier compra del sistema',     
        ]);

        //ESTIMACION.
        Permission::create([
            'name'          => 'Navegar presupuesto',
            'slug'          => 'estimacion.index',
            'description'   => 'Lista y navega todas las presupuesto del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una presupuesto',
            'slug'          => 'estimacion.show',
            'description'   => 'Ve en detalle cada presupuesto del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de presupuesto',
            'slug'          => 'estimacion.create',
            'description'   => 'Podría crear nuevas presupuesto en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de presupuesto',
            'slug'          => 'estimacion.edit',
            'description'   => 'Podría editar cualquier dato de una presupuesto del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar presupuesto',
            'slug'          => 'estimacion.destroy',
            'description'   => 'Podría eliminar cualquier presupuesto del sistema',     
        ]);

        //Mensual.
        Permission::create([
            'name'          => 'Navegar cta cte',
            'slug'          => 'mensual.index',
            'description'   => 'Lista y navega todas las cta cte del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una cta cte',
            'slug'          => 'mensual.show',
            'description'   => 'Ve en detalle cada cta cte del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de cta cte',
            'slug'          => 'mensual.create',
            'description'   => 'Podría crear nuevas cta cte en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de cta cte',
            'slug'          => 'mensual.edit',
            'description'   => 'Podría editar cualquier dato de una cta cte del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar cta cte',
            'slug'          => 'mensual.destroy',
            'description'   => 'Podría eliminar cualquier cta cte del sistema',     
        ]);

        //PAGOS.
        Permission::create([
            'name'          => 'Navegar pagos',
            'slug'          => 'pagos.index',
            'description'   => 'Lista y navega todas las pagos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de una pagos',
            'slug'          => 'pagos.show',
            'description'   => 'Ve en detalle cada pagos del sistema',            
        ]);
        
        Permission::create([
            'name'          => 'Creación de pagos',
            'slug'          => 'pagos.create',
            'description'   => 'Podría crear nuevas pagos en el sistema',
        ]);
        
        Permission::create([
            'name'          => 'Edición de pagos',
            'slug'          => 'pagos.edit',
            'description'   => 'Podría editar cualquier dato de una pagos del sistema',
        ]);
        
        Permission::create([
            'name'          => 'Eliminar pagos',
            'slug'          => 'pagos.destroy',
            'description'   => 'Podría eliminar cualquier pagos del sistema',     
        ]);

        


    }
}
