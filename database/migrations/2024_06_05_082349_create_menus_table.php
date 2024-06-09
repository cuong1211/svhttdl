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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_en')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('parent_id')->after('user_id')->nullable()->index();
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
            $table->boolean('in_menu')->after('parent_id')->default(false);
            $table->tinyInteger('order')->after('in_menu')->default(99);
            $table->softDeletes()->after('updated_at');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
