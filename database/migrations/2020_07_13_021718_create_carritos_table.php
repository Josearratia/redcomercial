<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_producto_empresa')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->decimal('total', 11, 2);
            
            $table->timestamps();
              
            $table->foreign('id_cliente')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('carritos');
    }
}
