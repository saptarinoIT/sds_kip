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
        Schema::create('nilai_alternatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternatif_id')->index()->nullable();
            $table->unsignedBigInteger('kriteria_id')->index()->nullable();
            $table->bigInteger('nilai');
            $table->timestamps();
            $table->foreign('alternatif_id')
                ->references('id')
                ->on('alternatif')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('kriteria_id')
                ->references('id')
                ->on('kriteria')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_alternatif');
    }
};
