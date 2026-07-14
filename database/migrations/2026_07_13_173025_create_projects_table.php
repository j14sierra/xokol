<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creates the `projects` table with project details, status, engagement counts, and timestamps.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image_carousel');
            $table->string('image_grid');
            $table->integer('grid_image_size')->default(1);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Removes the projects table if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
