<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function devices() {

        return $this->hasMany(Device::class)->orderByRaw('ISNULL(lastUpdate), lastUpdate ASC'); 

    } 

}
