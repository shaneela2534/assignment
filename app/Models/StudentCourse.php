<?php

namespace App\Models;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
    ];
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
