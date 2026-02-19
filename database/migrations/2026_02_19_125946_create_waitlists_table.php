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
        Schema::create('waitlists', function (Blueprint $table) {
            $table->id();
            
            // Required fields
            $table->string('full_name');
            $table->string('email')->unique();
            
            // Optional fields from form
            $table->string('jamb_score_range')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('preferred_course')->nullable();
            $table->string('other_course')->nullable();
            
            // Tracking fields
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->string('referrer')->nullable();
            $table->string('page_url')->nullable();
            
            // Device detection
            $table->string('device_type')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_tablet')->default(false);
            $table->boolean('is_desktop')->default(true);
            
            // Timestamps
            $table->timestamps();
            
            // Indexes for faster queries
            $table->index('email');
            $table->index('created_at');
            $table->index('state_of_origin');
            $table->index('preferred_course');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitlists');
    }
};