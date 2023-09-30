<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lottery_id',
        'transaction_type_id',
        'ticket_id',
        'amount',
        'details',
        'activated_at'
    ];

    /**
     * Get transaction user.
     *
     * @return BelongsTo The belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get transaction lottery.
     *
     * @return BelongsTo The belongs to.
     */
    public function lottery(): BelongsTo
    {
        return $this->belongsTo(Lottery::class);
    }

    /**
     * Get transaction type.
     *
     * @return BelongsTo The belongs to.
     */
    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    /**
     * Get transaction ticket.
     *
     * @return BelongsTo The belongs to.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Get transaction status.
     *
     * @return BelongsTo The belongs to.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
