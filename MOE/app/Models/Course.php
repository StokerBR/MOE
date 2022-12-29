<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function internships() {
        return $this->belongsToMany(Internship::class, 'internship_courses', 'course_id', 'internship_id');
    }

    public function scopeForInternship($query) {

        $query->from('courses as c')
        ->join('universities as u', 'u.id', 'c.university_id');

        $query->select('c.*', 'u.acronym');

        $query->orderBy('c.name', 'asc');

    }

}
