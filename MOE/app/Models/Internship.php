<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    public function courses() {
        return $this->belongsToMany(Course::class, 'internship_courses', 'internship_id', 'course_id')->withPivot('approved');
    }

    public function state() {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

}
