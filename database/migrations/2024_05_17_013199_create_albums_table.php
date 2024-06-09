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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('album_id')->index();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

            $table->string('name');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('album_id')->index();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

            $table->string('name');
            $table->string('video_id');
            $table->string('source')->default('google_drive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('videos');
    }
};
