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
            $table->string('title_en')->nullable();
            $table->unsignedInteger('parent_id')->after('user_id')->nullable()->index();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->boolean('in_menu')->after('parent_id')->default(false);
            $table->tinyInteger('order')->after('in_menu')->default(99);
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'parent_id',
                'in_menu',
                'order',
                'deleted_at',
            ]);
        });
    }
};
