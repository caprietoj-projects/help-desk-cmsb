<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesTable extends Migration
{
    public function up()
    {
        Schema::create('agentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('cargo');
            $table->string('correo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
