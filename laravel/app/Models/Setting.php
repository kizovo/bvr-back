<?php

namespace App\Models;

use App\Models\Model;

class Setting extends Model
{
    public function scopeCachedAll($query) {
        return $query->get();
    }
}
