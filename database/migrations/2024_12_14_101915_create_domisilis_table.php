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
        Schema::create('domisilis', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('penduduks');
            $table->string('alamat_asal');
            $table->string('alamat_tujuan');
            $table->date('tanggal_pindah');
            $table->string('alasan_pindah')->nullable();
            $table->string('link');
            $table->boolean('status')->default(0); # masuk/keluar 0 = keluar, 1 = masuk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domisilis');
    }
};
