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
        Schema::create('atribut', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id')->index()->nullable();
            $table->string('nama_atribut');
            $table->integer('nilai_atribut');
            $table->timestamps();
            $table->foreign('kriteria_id')
                ->references('id')
                ->on('kriteria')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atribut');
    }
};
