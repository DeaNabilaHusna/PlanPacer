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
        Schema::create('kontributor_proyeks', function (Blueprint $table) {
            $table->foreignId('proyek_id');
            $table->foreignId('kontributor_id');
            $table->timestamp('tgl_mulai')->default(now());
            $table->timestamp('tgl_selesai')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontributor_proyeks');
    }
};
