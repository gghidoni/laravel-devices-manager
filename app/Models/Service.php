<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function devices() {

        return $this->belongsTo(Device::class); 

    }

    public function user() {

        return $this->belongsTo(User::class);

    }

}
