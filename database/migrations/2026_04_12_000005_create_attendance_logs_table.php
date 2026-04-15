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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('session_id')->constrained('live_sessions')->onDelete('cascade');
            $table->timestamp('join_time')->useCurrent();
            $table->timestamp('exit_time')->nullable();
            $table->unsignedInteger('duration_minutes')->default(0);
            $table->timestamps();

            $table->index(['student_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
