<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_mengajar');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_pelajaran');
            $table->integer('semester');
            // $table->timestamps();

            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('restrict');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajaran')->onDelete('restrict');
            $table->foreign('id_mengajar')->references('id')->on('mengajar')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
