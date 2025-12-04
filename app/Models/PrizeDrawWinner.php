<?php

namespace App\Models;

use Database\Factories\PrizeDrawWinnerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrizeDrawWinner extends Model
{
    /** @use HasFactory<PrizeDrawWinnerFactory> */
    use HasFactory;

    protected $fillable = [
        'prize_draw_id',
        'user_prize_draw_id',
    ];

    public function prizeDraw(): BelongsTo
    {
        return $this->belongsTo(PrizeDraw::class, 'prize_draw_id');
    }

    public function userPrizeDraw(): BelongsTo
    {
        return $this->belongsTo(UsersPrizeDraw::class, 'user_prize_draw_id');
    }
}
