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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nkk');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rw')->nullable();
            $table->string('rt')->nullable();
            $table->string('alamat')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
