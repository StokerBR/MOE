<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    public function courses() {
        return $this->belongsToMany(Course::class, 'internship_courses', 'internship_id', 'course_id');
    }

}
