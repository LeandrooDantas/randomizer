<?php

namespace App\Models;

use Database\Factories\PrizeDrawFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrizeDraw extends Model
{
    /** @use HasFactory<PrizeDrawFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'quantity_participants',
        'winner',
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(UsersPrizeDraw::class, 'user_id', 'id');
    }
}
