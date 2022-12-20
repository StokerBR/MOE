<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    public function courses() {
        return $this->hasMany(InternshipCourse::class, 'internship_id', 'id');
    }

}
