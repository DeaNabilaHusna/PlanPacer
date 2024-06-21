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
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('owned_by_id')->nullable()->after('name');
            $table->foreign('owned_by_id')->references('id')->on('users')->onDelete('set null');
             $table->dropUnique(['name', 'guard_name']);
             $table->unique(['name', 'owned_by_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['owned_by_id']);
            $table->dropColumn('owned_by_id');
            $table->dropUnique(['name', 'guard_name']);
            $table->unique(['name', 'owned_by_id']);
        });
    }
};
