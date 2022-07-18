<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighStudentsModel extends Model
{
    use HasFactory;
    protected $table="high_students";
    protected $fillable = [
        'name',
        'email',
        'cell',
        'k12fp_number',
        'graduation_year',
        'grade',
        'school',
        'added_by'
    ];
}
