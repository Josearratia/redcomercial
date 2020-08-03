<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVpdetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vpdetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_venta')->unsigned();
            $table->integer('id_producto_empresa')->unsigned(); 
            $table->integer('cantidad')->unsigned();        
            $table->decimal('precio', 11, 2);
            
            $table->timestamps();
              
            $table->foreign('id_venta')->references('id')->on('ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_producto_empresa')->references('id')->on('pdempresas')->onUpdate('cascade')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vpdetalles');
    }
}
