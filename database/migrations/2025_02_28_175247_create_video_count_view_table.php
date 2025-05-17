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
        Schema::create('video_count_view', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('video_group_id')->constrained('group_videos')->onDelete('cascade');
            $table->foreignId('video_id')->constrained('videos')->onDelete('cascade');
            $table->decimal('rate', 2, 1)->nullable()->check('rate BETWEEN 1 AND 5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_count_view');
    }
};
