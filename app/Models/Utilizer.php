<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilizer extends Model
{
    use HasFactory;

    public function devices() {
        return $this->belongsToMany(Device::class);
    }

}
