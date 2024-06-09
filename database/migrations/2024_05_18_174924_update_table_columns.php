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
        Schema::table('announcements', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
        Schema::table('photos', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
        Schema::table('cooperations', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
