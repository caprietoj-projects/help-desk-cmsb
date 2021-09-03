<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasTecnicasTable extends Migration
{
    public function up()
    {
        Schema::create('fichas_tecnicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('encargado');
            $table->string('nombre_del_equipo');
            $table->string('modelo')->nullable();
            $table->string('serial')->nullable();
            $table->longText('observaciones')->nullable();
            $table->date('mantenimiento_preventivo')->nullable();
            $table->date('mantenimiento_correctivo')->nullable();
            $table->longText('descripcion_del_mantenimiento')->nullable();
            $table->string('estado_del_activo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
