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
    //     Schema::create('user_tasks', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('penanggungjawab_id')->constrained('users')->onDelete('cascade');
    //         $table->foreignId('proyek_id')->constrained('proyeks')->onDelete('cascade');
    //         $table->foreignId('modul_id')->constrained('kartu_tugas')->onDelete('cascade');
    //         // $table->foreignId('tugas_id')->constrained('tugas_items')->onDelete('cascade');
    //         $table->string('email_penanggungjawab');
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_manager_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->string('project_manager_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tasks');
    }
};
