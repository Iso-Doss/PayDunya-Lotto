<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperLotteryStatus
 */
class LotteryStatus extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lottery_id',
        'status_id',
        'details',
        'activated_at'
    ];

    /**
     * Get the lottery.
     *
     * @return BelongsTo The belongs to.
     */
    public function lottery(): BelongsTo
    {
        return $this->belongsTo(Lottery::class);
    }

    /**
     * Get the status.
     *
     * @return BelongsTo The belongs to.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
