<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('kartu_tugas', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('proyek_id');
    //         $table->string('nama_kartu');
    //         $table->string('slug')->unique(); 
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('modul_name');
            $table->string('slug')->unique(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
