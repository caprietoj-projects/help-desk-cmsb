<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioridadsTable extends Migration
{
    public function up()
    {
        Schema::create('prioridads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_de_prioridad');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
