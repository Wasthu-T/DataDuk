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
            $table->string('nik')->primary();
            $table->string('nama');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('jns_kel');
            $table->enum('gol_d',['A','B','AB','O']);
            $table->string('alamat');
            $table->string('agama');
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
        Schema::dropIfExists('penduduks');
    }
};
