<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVsdetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vsdetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_venta')->unsigned();
            $table->integer('id_servicio_empresa')->unsigned(); 
            $table->integer('cantidad')->unsigned();        
            $table->decimal('precio', 11, 2);
            
            $table->timestamps();
              
            $table->foreign('id_venta')->references('id')->on('ventas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_servicio_empresa')->references('id')->on('seempresas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vsdetalles');
    }
}
