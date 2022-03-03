<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('waktu_masuk')->nullable();
            $table->string('akhir_waktu_masuk')->nullable();
            $table->string('waktu_keluar')->nullable();
            $table->string('akhir_waktu_keluar')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_kecil')->nullable();
            $table->string('nama_aplikasi')->nullable();
            $table->string('copyright')->nullable();
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
        // Schema::dropIfExists('pengaturan');
    }
}
