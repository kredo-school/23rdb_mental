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
        // Migration file for feedbacks table
Schema::create('feedbacks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->integer('month'); // Store the month (1-12)
    $table->year('year'); // Store the year
    $table->text('feedback'); // Store the feedback text
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
