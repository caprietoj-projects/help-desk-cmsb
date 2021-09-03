<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFichasTecnicasTable extends Migration
{
    public function up()
    {
        Schema::table('fichas_tecnicas', function (Blueprint $table) {
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id', 'sede_fk_4571517')->references('id')->on('sedes');
            $table->unsignedBigInteger('quien_lo_realiza_id');
            $table->foreign('quien_lo_realiza_id', 'quien_lo_realiza_fk_4571524')->references('id')->on('agentes');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4571529')->references('id')->on('users');
        });
    }
}
