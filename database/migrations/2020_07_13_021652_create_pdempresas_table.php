<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdempresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('stock')->unsigned();
            $table->decimal('precio', 11, 2);
            
            
            $table->timestamps();
              
            $table->foreign('id_empresa')->references('id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_producto')->references('id')->on('productos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdempresas');
    }
}
