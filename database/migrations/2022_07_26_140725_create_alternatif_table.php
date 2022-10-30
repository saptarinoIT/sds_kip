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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('kode_alternatif');
            $table->string('jenjang');
            $table->string('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('universitas')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pek_ayah')->nullable();
            $table->string('pek_ibu')->nullable();
            $table->string('pek_wali')->nullable();
            $table->integer('peng_ayah')->nullable();
            $table->integer('peng_ibu')->nullable();
            $table->integer('peng_wali')->nullable();
            $table->integer('pangan')->nullable();
            $table->integer('sandang')->nullable();
            $table->integer('pdam')->nullable();
            $table->integer('listrik')->nullable();
            $table->integer('internet')->nullable();
            $table->integer('pulsa')->nullable();
            $table->integer('transportasi')->nullable();
            $table->integer('cicilan')->nullable();
            $table->integer('sewa_rumah')->nullable();
            $table->text('keterangan')->nullable();
            $table->year('tahun');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('alternatif');
    }
};
