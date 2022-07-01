<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ufs', function (Blueprint $table) {
            $table->id();
            $table->char('sigla',2);
            $table->string('nome');
          
            $table->string('slug');
            $table->uuid('uuid');

            $table->foreignId('regiao_id')->constrained()->onDelete('cascade');
            #por causa disso tem q percorrer 2x o loop
            $table->foreignId('mesorregiao_id')->nullable()->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('ufs');
    }
};
