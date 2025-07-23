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
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('email');
            $table->enum('degree', ['Diploma', 'UG', 'PG']);
            $table->string('major');
            $table->integer('age');
            $table->enum('mode', ['Online', 'Offline']);
            $table->enum('professional', ['Student', 'JobSeeker', 'Fresher', 'NonIT-IT', 'WorkingProfessional']);
            $table->integer('experience')->nullable();
            $table->json('time_slot');
            $table->string('course');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};
