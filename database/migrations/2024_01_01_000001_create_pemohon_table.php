<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_berkas')->unique();
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->string('email')->nullable();
            $table->date('tanggal_pengajuan');
            $table->string('jenis_permohonan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};
