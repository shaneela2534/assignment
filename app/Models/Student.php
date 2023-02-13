<?php

namespace App\Models;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table="students";
    protected $fillable = [
        'name',
        'dob',
        'note'
    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class,'student_courses');
    }
}
