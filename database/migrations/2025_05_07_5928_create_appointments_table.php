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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_time')->nullable();;
            $table->timestamp('end_time')->nullable();;
            $table->foreignId('doctor_id')->nullable()->constrained('admins')->onDelete('cascade');
            // $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            // $table->enum('status',['accepted','cancelled','pending'])->default('pending');
            $table->foreignId('clinic_id')->nullable()->constrained('clinics')->onDelete('cascade');
            $table->boolean('booked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
