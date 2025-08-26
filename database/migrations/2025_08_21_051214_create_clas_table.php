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
        Schema::create('clas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_id')
              ->constrained('academics')
              ->onDelete('cascade')
              ->index(); // add index for faster filtering by year
            $table->string('clas_name', 50);
            $table->string('clas_code', 20)->unique(); // unique = auto-indexed
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->integer('max_students')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->timestamps();
               $table->foreign('teacher_id')
              ->references('id')
              ->on('teachers')
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clas');
    }
};
