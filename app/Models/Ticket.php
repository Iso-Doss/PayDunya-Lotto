<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTicket
 */
class Ticket extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'short_description',
        'description',
        'image',
        'activated_at'
    ];

    /**
     * Get the ticket transactions.
     *
     * @return HasMany The has many.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
