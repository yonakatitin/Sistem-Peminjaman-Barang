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
        Schema::create('requestpeminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('barang_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('barang_id')->references('id')->on('barang')->cascadeOnDelete();
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->date('tgl_reservasi');
            $table->enum('status_pinjam', ['requested', 'approved','declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requestpeminjaman');
    }
};
