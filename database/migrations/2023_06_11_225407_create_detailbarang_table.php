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
        Schema::create('detailbarang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('detail')->nullable();
            $table->string('gambar', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailbarang');
    }
};
