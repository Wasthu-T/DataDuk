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
        Schema::create('statuspenduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('penduduks');
            $table->string('nama');
            $table->string('alamat');
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('stt_kawin',['kawin','belum kawin']);
            $table->string('pekerjaan');
            $table->enum('kwn', ['WNI','WNA']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuspenduduks');
    }
};
