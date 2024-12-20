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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('audio')->nullable()->comment('Đường dẫn file audio');
            $table->string('file')->nullable()->comment('Đường dẫn file đính kèm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('audio');
            $table->dropColumn('file');
        });
    }
};
