<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('id_incidente_id');
            $table->foreign('id_incidente_id', 'id_incidente_fk_4517773')->references('id')->on('incidentes');
            $table->unsignedBigInteger('id_prioridad_id');
            $table->foreign('id_prioridad_id', 'id_prioridad_fk_4517774')->references('id')->on('prioridads');
            $table->unsignedBigInteger('id_sede_id');
            $table->foreign('id_sede_id', 'id_sede_fk_4517775')->references('id')->on('sedes');
            $table->unsignedBigInteger('id_estado_id')->nullable();
            $table->foreign('id_estado_id', 'id_estado_fk_4517778')->references('id')->on('estados');
            $table->unsignedBigInteger('id_asignado_id')->nullable();
            $table->foreign('id_asignado_id', 'id_asignado_fk_4517916')->references('id')->on('agentes');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4517782')->references('id')->on('users');
        });
    }
}
