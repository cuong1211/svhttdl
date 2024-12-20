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
        Schema::table('addons', function (Blueprint $table) {
            $table->string('state')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('is_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->dropColumn('state');
            $table->dropColumn('user_id');
            $table->dropColumn('is_active');
        });
    }
};
