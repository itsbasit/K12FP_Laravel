<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    use HasFactory;
    protected $table="students";
    protected $fillable = [
        'name',
        'email',
        'cell',
        'k12fp_number',
        'graduation_year',
        'grade',
        'school',
        'added_by',
        'student_type'
    ];
}
