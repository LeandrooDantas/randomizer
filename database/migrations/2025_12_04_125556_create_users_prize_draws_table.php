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
        Schema::create('users_prize_draws', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('registration_number', 8)->unique();
            $table->string('section', 100);
            $table->string('branch', 100);
            $table->foreignId('prize_draw_id')->constrained('prize_draws')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_prize_draws');
    }
};
