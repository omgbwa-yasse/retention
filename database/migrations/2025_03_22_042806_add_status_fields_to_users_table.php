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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['admin', 'superadmin', 'reader'])->default('reader');
            $table->boolean('is_actived')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamp('actived_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->unsignedBigInteger('actived_by')->nullable();
            $table->unsignedBigInteger('archived_by')->nullable();

            $table->foreign('actived_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('archived_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['actived_by']);
            $table->dropForeign(['archived_by']);

            $table->dropColumn([
                'status',
                'is_actived',
                'is_archived',
                'actived_at',
                'archived_at',
                'actived_by',
                'archived_by',
            ]);
        });
    }
};
