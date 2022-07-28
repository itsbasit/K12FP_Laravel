<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentsModel extends Model
{
    use HasFactory,SoftDeletes;
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
