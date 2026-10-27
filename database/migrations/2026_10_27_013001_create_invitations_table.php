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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->text('bride_parents')->nullable();
            $table->text('groom_parents')->nullable();
            $table->date('event_date');
            $table->time('event_time');
            $table->text('address');
            $table->string('venue_name');
            $table->string('maps_link')->nullable();
            $table->text('maps_embed')->nullable();
            $table->text('story')->nullable();
            $table->string('music_path')->nullable();
            $table->string('background_image')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->json('settings_json')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
