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
        Schema::table('pemohon', function (Blueprint $table) {
            $table->text('nik')->change();
            $table->text('nama_lengkap')->change();
            $table->text('tempat_lahir')->change();
            $table->text('alamat')->change();
            $table->text('no_hp')->change();
            $table->text('email')->change();
            $table->string('nik_hash')->nullable()->after('nik')->index();
        });
    }

    public function down(): void
    {
        Schema::table('pemohon', function (Blueprint $table) {
            $table->string('nik', 16)->change();
            $table->string('nama_lengkap')->change();
            $table->string('tempat_lahir')->change();
            $table->string('no_hp', 20)->change();
            $table->string('email')->change();
            $table->dropColumn('nik_hash');
        });
    }
};
