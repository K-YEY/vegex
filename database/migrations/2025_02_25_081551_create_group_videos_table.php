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
        Schema::create('group_videos', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->integer('count_subscribers')->default(0);
            $table->integer('total_videos')->default(0);
            $table->integer('max_videos')->nullable();
            $table->integer('join_max')->nullable();
            $table->decimal('rate', 2, 1)->nullable()->check('rate BETWEEN 1 AND 5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_videos');
    }
};
