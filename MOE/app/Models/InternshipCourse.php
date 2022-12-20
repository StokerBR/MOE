<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipCourse extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function internship() {
        return $this->belongsTo(Internship::class, 'internship_id', 'id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

}
