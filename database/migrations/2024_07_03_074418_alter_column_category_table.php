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
        Schema::table('categories', function (Blueprint $table) {
            // change nulllable to true
            $table->boolean('in_menu')->nullable()->default(false)->change();
            $table->tinyInteger('order')->nullable()->default(99)->change();
            $table->unsignedInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('in_menu')->nullable(false)->change();
            $table->tinyInteger('order')->nullable(false)->change();
            $table->unsignedInteger('user_id')->nullable(false)->change();
        });
    }
};
