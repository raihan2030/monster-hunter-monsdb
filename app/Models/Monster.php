<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Monster extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'isLarge'    => 'boolean',
        'subSpecies' => 'array',
        'elements'   => 'array',
        'ailments'   => 'array',
        'weakness'   => 'array',
    ];

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Series::class, 'monster_series')
            ->withPivot('image', 'info', 'danger')
            ->withTimestamps();
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );

        $query->when($filters['size'] ?? false, function ($query, $size) {
            if ($size === 'large') {
                return $query->where('isLarge', true);
            } elseif ($size === 'small') {
                return $query->where('isLarge', false);
            }
        });
    }
}
