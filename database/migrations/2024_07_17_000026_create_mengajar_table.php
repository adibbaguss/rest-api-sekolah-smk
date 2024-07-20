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
        Schema::create('mengajar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_mengajar');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');
            $table->integer('semester');
            // $table->timestamps();

            /**
             * relasi
             */
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('restrict');
            $table->foreign('id_guru')->references('id')->on('guru')->onDelete('restrict');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajaran')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mengajar');
    }
};
