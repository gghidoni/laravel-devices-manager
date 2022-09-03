<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;


    public function typology() {

        return $this->belongsTo(Typology::class);

    }

    public function department() {

        return $this->belongsTo(Department::class);

    }

    public function service() {

        return $this->belongsTo(Service::class);

    }

    public function utilizers()
    {
        return $this->belongsToMany(Utilizer::class);
    }

}
