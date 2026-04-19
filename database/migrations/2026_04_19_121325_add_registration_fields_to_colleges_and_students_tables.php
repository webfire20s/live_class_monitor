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
        Schema::table('colleges', function (Blueprint $table) {
            $table->text('address')->nullable()->after('name');
            $table->string('contact_number')->nullable()->after('address');
            $table->string('username')->unique()->nullable()->after('contact_number');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('name');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->string('class_name')->nullable()->after('mother_name');
            $table->boolean('is_approved')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colleges', function (Blueprint $table) {
            $table->dropColumn(['address', 'contact_number', 'username']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['father_name', 'mother_name', 'class_name', 'is_approved']);
        });
    }
};
