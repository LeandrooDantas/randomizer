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
        Schema::create('prize_draw_winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prize_draw_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_prize_draw_id')->constrained('users_prize_draws')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prize_draw_winners');
    }
};
