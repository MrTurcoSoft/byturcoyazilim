<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SEO settings table
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_identifier')->unique(); // home, about, services, etc.
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });

        // Google Calendar tokens
        Schema::create('google_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('access_token');
            $table->text('refresh_token')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // Add calendar event id to quotes
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('calendar_event_id')->nullable()->after('quoted_amount');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
        Schema::dropIfExists('google_tokens');
        
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('calendar_event_id');
        });
    }
};
