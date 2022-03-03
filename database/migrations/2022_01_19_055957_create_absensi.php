<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('absensi_masuk')->nullable();
            $table->string('absensi_keluar')->nullable();
            $table->string('token_masuk')->nullable();
            $table->string('token_keluar')->nullable();
            $table->string('durasi_kerja')->nullable();
            $table->integer('user_id');
            $table->integer('perizinan_id')->nullable();
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
        Schema::dropIfExists('absensi');
    }
}
