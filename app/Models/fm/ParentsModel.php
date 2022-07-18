<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentsModel extends Model
{
    use HasFactory;
    protected $table = 'parents';
    protected $fillable = [
        'parentName',
        'parentEmail',
        'parentCell',
        'student'
    ];
}
