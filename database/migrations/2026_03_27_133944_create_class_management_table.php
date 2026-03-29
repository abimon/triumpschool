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
        Schema::create('class_management', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('program_id')->constrained('courses')->onDelete('cascade');
            $table->string('description')->nullable();
            $table ->string('date_time');
            $table->string('address');
            $table->string('status')->default('scheduled');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_management');
    }
};
