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

    public function scopeForCoordinator($query, $courseCoordinator) {

        $query->from('internships as i')
        ->leftJoin('internship_courses as ic', 'ic.internship_id', 'i.id');

        $query->where('ic.course_id', $courseCoordinator->course_id);

        $query->select('i.*', 'ic.id as ic_id', 'ic.approved');
        $query->selectRaw('(CASE WHEN ic.approved is null THEN 1 ELSE 0 END) as pending_approval');

        $query->orderBy('pending_approval', 'desc')
        ->orderBy('id', 'desc');

    }

    public function scopeForStudent($query, $student) {

        $query->from('internships as i')
        ->leftJoin('internship_courses as ic', 'ic.internship_id', 'i.id');

        $query->where('ic.course_id', $student->course_id);
        $query->where('ic.approved', true);

        $query->select('i.*', 'ic.id as ic_id');

        $query->orderBy('id', 'desc');

    }

}
