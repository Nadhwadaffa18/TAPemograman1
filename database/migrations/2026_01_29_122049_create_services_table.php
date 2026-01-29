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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('icon', 50)->default('bi-camera');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->string('satuan', 30)->nullable(); // per jam, per produk, dll
            $table->enum('tipe', ['layanan', 'paket'])->default('layanan');
            $table->boolean('is_featured')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
