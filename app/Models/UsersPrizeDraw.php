<?php

namespace App\Models;

use Database\Factories\UsersPrizeDrawFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersPrizeDraw extends Model
{
    /** @use HasFactory<UsersPrizeDrawFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'prize_draw_id',
        'registration_number',
        'section',
        'branch',
    ];

    public function prizeDraw(): belongsTo
    {
        return $this->belongsTo(PrizeDraw::class, 'prize_draw_id');
    }
}
