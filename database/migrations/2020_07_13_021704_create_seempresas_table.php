<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seempresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_empresa')->unsigned();
            $table->integer('id_servicio')->unsigned();
            $table->decimal('precio', 11, 2);
            
            $table->timestamps();
              
            $table->foreign('id_empresa')->references('id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id')->on('servicios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seempresas');
    }
}
