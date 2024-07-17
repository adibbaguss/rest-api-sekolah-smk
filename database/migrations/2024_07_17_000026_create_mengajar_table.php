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
            $table->unsignedBigInteger('id_guru'); // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('id_kelas'); // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('id_mapel'); // Use unsignedBigInteger for foreign keys
            $table->integer('semester');
            $table->timestamps();

            /**
             * relasi
             */
            $table->foreign('id_guru')->references('id')->on('guru');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajaran');
            $table->foreign('id_kelas')->references('id')->on('kelas');
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
