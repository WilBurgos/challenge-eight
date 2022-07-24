<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatastroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catastro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fid')->nullable();
            $table->longText('geo_shape')->nullable();
            $table->string('call_numero')->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->string('colonia_predio')->nullable();
            $table->double('superficie_terreno')->nullable();
            $table->double('superficie_construccion')->nullable();
            $table->string('uso_construccion')->nullable();
            $table->string('clave_rango_nivel')->nullable();
            $table->integer('anio_construccion')->nullable();
            $table->string('instalaciones_especiales')->nullable();
            $table->double('valor_unitario_suelo')->nullable();
            $table->double('valor_suelo')->nullable();
            $table->string('clave_valor_unitario_suelo')->nullable();
            $table->string('colonia_cumpliemiento')->nullable();
            $table->string('alcaldia_cumplimiento')->nullable();
            $table->double('subsidio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catastro');
    }
}
