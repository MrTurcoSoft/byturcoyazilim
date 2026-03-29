<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('meet_link')->nullable()->after('calendar_event_id');
            $table->boolean('wants_meeting')->default(false)->after('preferred_time');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['meet_link', 'wants_meeting']);
        });
    }
};
