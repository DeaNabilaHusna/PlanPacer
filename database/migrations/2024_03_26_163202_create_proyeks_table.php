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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_id');
            $table->string('nama_proyek');
            $table->string('penanggungjawab_proyek');
            $table->text('deskripsi_proyek')->nullable();
            $table->string('url_proyek')->nullable();
            $table->enum('visibilitas', ['private', 'terbatas'])->default('private');
            $table->enum('status_proyek', ['sedang berjalan', 'selesai'])->default('sedang berjalan');
            $table->date('tgl_mulai_proyek')->default(now());;
            $table->date('tgl_selesai_proyek');
            $table->json('kolaborator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
