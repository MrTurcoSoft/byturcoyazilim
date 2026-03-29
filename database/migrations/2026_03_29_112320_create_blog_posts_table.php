<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('slug');
            $table->json('excerpt')->nullable();
            $table->json('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
