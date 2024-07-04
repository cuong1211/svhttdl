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
            $table->softDeletes();
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('albums', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('cooperations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('document', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('document_signers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('document_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('photos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('post_tags', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->softDeletes();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('albums', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('cooperations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('document', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('document_signers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('document_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('photos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_categories', function (Blueprint $blueprint) {
            $blueprint->dropSoftDeletes();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
