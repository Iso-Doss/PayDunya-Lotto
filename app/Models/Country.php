<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperCountry
 */
class Country extends Model
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
        'phone_code',
        'activated_at'
    ];

    /**
     * Get the country users.
     *
     * @return HasMany The has many.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
