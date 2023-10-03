<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperLottery
 */
class Lottery extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'date',
        'jackpot',
        'numbers_drawn',
        'description',
        'short_description',
        'image',
        'video',
        'status_id',
        'activated_at'
    ];

    /**
     * Get lottery status.
     *
     * @return BelongsTo The belongs to.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the lottery statuses.
     *
     * @return BelongsToMany The belongs to many.
     */
    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class)->withTimestamps()->withPivot(['details'])->orderBy('id', 'desc');
    }

    /**
     * Get the lottery users.
     *
     * @return BelongsToMany The belongs to many.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['details', 'numbers_drawn'])->orderBy('id', 'desc');
        //return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['details'])->orderBy('id', 'desc');
    }
}
