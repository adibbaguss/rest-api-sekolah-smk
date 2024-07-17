<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nisn', 10)->unique();
            $table->string('nama_lengkap', 50);
            $table->char('jenis_kelamin', 1);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 50);
            $table->text('alamat');
            $table->string('nomor_telepon', 20);
            $table->string('email', 50);
            $table->integer('id_jurusan')->unsigned();
            $table->enum('status_aktif', ['aktif', 'lulus', 'keluar']);
            $table->year('tahun_masuk');
            $table->year('tahun_lulus')->nullable();
            $table->timestamps();

            $table->foreign('id_jurusan')->references('id')->on('jurusan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
