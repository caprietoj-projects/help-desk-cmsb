<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponenteFichasTecnicaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('componente_fichas_tecnica', function (Blueprint $table) {
            $table->unsignedBigInteger('fichas_tecnica_id');
            $table->foreign('fichas_tecnica_id', 'fichas_tecnica_id_fk_4678130')->references('id')->on('fichas_tecnicas')->onDelete('cascade');
            $table->unsignedBigInteger('componente_id');
            $table->foreign('componente_id', 'componente_id_fk_4678130')->references('id')->on('componentes')->onDelete('cascade');
        });
    }
}
