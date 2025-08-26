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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('academic_id')->constrained('academics')->onDelete('cascade');
            $table->foreignId('clas_id')->constrained('clas')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->string('roll_number', 20)->unique();
            $table->date('admission_date');
            $table->date('dob');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('blood_group', 5)->nullable();
            $table->text('address');
            $table->string('parent_name', 100);
            $table->string('parent_contact', 20);
            $table->enum('status', ['active', 'inactive', 'graduated', 'left'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
