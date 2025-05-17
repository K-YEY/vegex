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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('video_path');
            $table->decimal('rate', 2, 1)->nullable()->check('rate BETWEEN 1 AND 5');
            $table->boolean('is_active')->default(true);
            $table->integer('count_view')->default(0);
            $table->boolean('is_free')->default(0);
            $table->bigInteger('duration')->nullable();
            $table->longText('cover')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
