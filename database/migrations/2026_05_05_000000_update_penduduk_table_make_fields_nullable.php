<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('jenis_kelamin')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->string('agama')->nullable()->change();
            $table->string('status_perkawinan')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->string('jenis_kelamin')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->string('agama')->nullable(false)->change();
            $table->string('status_perkawinan')->nullable(false)->change();
        });
    }
};
