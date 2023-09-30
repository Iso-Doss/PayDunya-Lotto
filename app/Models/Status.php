<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperStatus
 */
class Status extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'message',
        'entity',
        'priority_level',
        'icon',
        'color',
        'activated_at'
    ];

    /**
     * Get the status lotteries.
     *
     * @return BelongsToMany The belongs to many.
     */
    public function lotteries(): BelongsToMany
    {
        return $this->belongsToMany(Lottery::class)->withTimestamps();
    }

    /**
     * Get the status transactions.
     *
     * @return BelongsToMany The belongs to many.
     */
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class)->withTimestamps();
    }
}
