<?php

use App\Models\subjects;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(subjects::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('grade')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->string('hours')->nullable();
            $table->string('gpa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
