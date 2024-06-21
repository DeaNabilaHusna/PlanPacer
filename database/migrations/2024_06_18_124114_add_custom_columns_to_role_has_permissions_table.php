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
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_by_id')->nullable();
        $table->foreign('assigned_by_id')->references('owned_by_id')->on('roles')->onDelete('set null');
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign(['assigned_by_id']);
            $table->dropColumn('assigned_by_id');
        });
    }
};
