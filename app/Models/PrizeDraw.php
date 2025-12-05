<?php

namespace App\Models;

use Database\Factories\PrizeDrawFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrizeDraw extends Model
{
    /** @use HasFactory<PrizeDrawFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity_participants',
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(UsersPrizeDraw::class, 'prize_draw_id');
    }

    public function winners(): HasMany
    {
        return $this->hasMany(PrizeDrawWinner::class, 'prize_draw_id');
    }
}
