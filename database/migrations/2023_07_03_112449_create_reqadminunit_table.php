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
        Schema::create('reqadminunit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('alamat');
            $table->string('no_hp', 100);
            $table->enum('status',['requested','approved','declined']);
            $table->foreignId('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit')->cascadeOnDelete()->cascadeOnUpdate();
            /* Users: 0=>User, 1=>Admin Unit, 2=>Administrator */
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reqadminunit');
    }
};
