<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeFilter($query, array $filters) {

        // query per ricerca
        // $query->when($filters['search'] ?? false, fn($query, $search) => 
        // $query
        //     ->where('title', 'like', '%' . $search . '%')); 


        // query per filtraggio
        // $query->when($filters['category'] ?? false, fn($query, $category) => 
        // $query
        //     ->where('title', 'like', '%' . $search . '%'));



    }


    public function typology() {

        return $this->belongsTo(Typology::class);

    }

    public function department() {

        return $this->belongsTo(Department::class);

    }

    public function services() {

        return $this->hasMany(Service::class);

    }

    public function utilizers()
    {
        return $this->belongsToMany(Utilizer::class);
    }

}
