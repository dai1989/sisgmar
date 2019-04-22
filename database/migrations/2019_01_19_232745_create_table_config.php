<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
          $table->increments('id')->comment('id de la configuración');
          $table->string('nombre' , 500)->nullable()->comment('nombre del negocio');
          $table->string('imagen', 50)->default('logo.jpg');
          $table->string('lema' , 500)->nullable()->comment('lema del negocio');
          $table->string('cuit' , 500)->nullable()->comment('numero de comuento del negocio');
          $table->string('telefono' , 500)->nullable()->comment('telefono del negocio');
          $table->string('correo' , 500)->nullable()->comment('correo del negocio');
          $table->string('impuesto' , 500)->nullable()->comment('impuesto que tiene el negocio');
          $table->string('condicion_iva' , 500)->nullable()->comment('condicion frente al iva');
          $table->string('idusuario' , 500)->nullable()->comment('id del usuario que lo modifica');
          $table->string('alert_minima' , 500)->nullable()->comment('alerta de los producos minimas');
          $table->string('alert_maxima' , 500)->nullable()->comment('alarta de los produtos maximas');
          $table->string('estadistica_diaz' , 500)->default('7')->comment('los productos mas vendidos del negocio');
          $table->string('pro_vendidos' , 500)->nullable()->comment('los productos mas vendidos del negocio');
          $table->string('pro_recaudacion' , 500)->nullable()->comment('productos con mayor recaudación');
          $table->string('menu_mini' , 500)->nullable()->comment('menu del sistema minimisado o maximisado');
          $table->string('direccion' , 500)->nullable()->comment('direccion del negocio');
          $table->string('campo1' , 500)->nullable()->comment('campo a poner por si hace falta algo');
          $table->string('campo2' , 500)->nullable()->comment('campo a poner por si hace falta algo');
          $table->string('producto_paginate' , 500)->default('7')->comment('paginación de los productos');
          $table->string('producto_orden' , 500)->default('asc')->comment('orden de los productos en la tabla');
          $table->string('categoria_paginate' , 500)->default('7')->comment('paginación de las categorias');
          $table->string('categoria_orden' , 500)->default('asc')->comment('orden de las categorias en la tabla');
          $table->string('cliente_paginate' , 500)->default('7')->comment('paginación de los clientes');
          $table->string('cliente_orden' , 500)->default('asc')->comment('orden de los clientes en la tabla');
          $table->string('proveedores_paginate' , 500)->default('7')->comment('paginación de los proveedores');
          $table->string('proveedores_orden' , 500)->default('asc')->comment('orden de los proveedores en la tabla');
          $table->string('usuario_paginate' , 500)->default('7')->comment('paginación de los usuarios');
          $table->string('usuario_orden' , 500)->default('asc')->comment('orden de los usuarios en la tabla');
          $table->timestamps();
          $table->softDeletes();


        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
