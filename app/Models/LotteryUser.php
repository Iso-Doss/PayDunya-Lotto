<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperLotteryUser
 */
class LotteryUser extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lottery_id',
        'user_id',
        'amount',
        'details',
        'status_id',
        'activated_at'
    ];

    /**
     * Get the lottery.
     *
     * @return BelongsTo The belongs to,
     */
    public function lottery(): BelongsTo
    {
        return $this->belongsTo(Lottery::class);
    }

    /**
     * Get the user.
     *
     * @return BelongsTo The belongs to,
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status.
     *
     * @return BelongsTo The belongs to,
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
