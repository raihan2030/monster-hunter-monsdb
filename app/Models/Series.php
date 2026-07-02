<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded = ['id'];

    public function monsters()
    {
        return $this->belongsToMany(Monster::class, 'monster_series')
            ->withPivot('image', 'info', 'danger')
            ->withTimestamps();
    }
}
