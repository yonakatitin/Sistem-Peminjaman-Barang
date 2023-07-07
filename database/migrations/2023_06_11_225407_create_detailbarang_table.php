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
            $table->foreignId('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->cascadeOnDelete();
            $table->text('detail');
            $table->string('gambar', 100);
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
