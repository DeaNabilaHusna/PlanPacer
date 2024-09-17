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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('project_name');
            $table->string('slug')->unique(); 
            $table->string('project_manager');
            $table->text('project_description')->nullable();
            $table->string('project_url')->nullable();
            $table->string('project_location')->nullable();
            $table->string('contact_person')->nullable();
            $table->enum('visibility', ['private', 'terbatas'])->default('private');
            $table->enum('project_status', ['sedang berjalan', 'selesai', 'terlambat'])->default('sedang berjalan');
            $table->date('project_start_date')->default(now());;
            $table->date('project_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
