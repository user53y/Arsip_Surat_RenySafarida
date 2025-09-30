<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->unsignedBigInteger('kategori_id');
            $table->string('judul');
            $table->string('file_pdf'); // path file
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_surat')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('arsip_surat');
    }
};
