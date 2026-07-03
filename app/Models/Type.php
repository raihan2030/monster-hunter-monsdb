<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function monsters()
    {
        return $this->hasMany(Monster::class);
    }
}
