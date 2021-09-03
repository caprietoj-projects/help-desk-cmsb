<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHojasDeVidaMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::table('hojas_de_vida_mantenimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id', 'sede_fk_4678392')->references('id')->on('sedes');
            $table->unsignedBigInteger('quien_lo_realiza_id');
            $table->foreign('quien_lo_realiza_id', 'quien_lo_realiza_fk_4678398')->references('id')->on('agentes');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4678401')->references('id')->on('users');
        });
    }
}
