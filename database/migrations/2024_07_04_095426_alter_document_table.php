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
        Schema::table('document', function (Blueprint $table) {
            $table->renameColumn('signer_id','tag_id')->nullable()->after('type_id');
            $table->string('signer')->nullable()->after('type_id');
            $table->string('notes')->nullable()->change();
            $table->string('document_file')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document', function (Blueprint $table) {
            $table->renameColumn('tag_id','signer_id')->nullable()->after('type_id');
            $table->dropColumn('signer');
            $table->string('notes')->nullable(false)->change();
            $table->dropColumn('document_file');
            $table->dropColumn('user_id');
            $table->string('slug')->nullable(false)->change();

        });
    }
};
