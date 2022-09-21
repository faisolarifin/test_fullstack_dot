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
//        Schema::create('agama', function (Blueprint $table) {
//            $table->id('id_agm');
//            $table->string('nm_agama');
//            $table->timestamps();
//        });
//        Schema::create('pendidikan', function (Blueprint $table) {
//            $table->id('id_pdk');
//            $table->string('nm_pendidikan');
//            $table->timestamps();
//        });
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id('id_pkj');
            $table->string('nm_pekerjaan');
            $table->timestamps();
        });
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->id('id_kk');
            $table->char('no_kk', 15)->unique();
            $table->string('nm_kepala');
            $table->string('alamat');
            $table->string('kabupaten');
            $table->integer('kodepos');
            $table->string('provinsi');
            $table->timestamps();
        });
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->unsignedBigInteger('id_kk');
            $table->foreign('id_kk')->references('id_kk')->on('kartu_keluarga')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('id_pkj');
            $table->foreign('id_pkj')->references('id_pkj')->on('pekerjaan')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->char('nik', 15)->unique();
            $table->string('nama');
            $table->enum('jenkel', ['L', 'P']);
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->enum('status_kawin', ['kawin', 'belum kawin']);
//            $table->enum('status', ['kepala keluarga', 'istri', 'anak', 'ibu', 'mertua']);
            $table->string('nm_ayah');
            $table->string('nm_ibu');
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
        Schema::dropIfExists('anggota');
        Schema::dropIfExists('kartu_keluarga');
        Schema::dropIfExists('pekerjaan');
    }
};
