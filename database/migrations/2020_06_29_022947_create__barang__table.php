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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_unit');
            $table->foreignId('id_kategori');
            $table->foreign('id_unit')->references('id')->on('unit')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kategori')->references('id')->on('kategori')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_barang',100);
            $table->string('merk',100);
            $table->string('serial_number',100);
            $table->text('deskripsi');
            $table->enum('status_barang', ['available', 'in use','broken']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
