<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class FundraiserPagesModel extends Model
{
    use Sluggable,SoftDeletes;

    use HasFactory;
    protected $table = "pages";
    protected $fillable = [
        'fundraiser',
        'student_goal',
        'team',
        'featured_image',
        'student',
        'created_by'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', date("Y-m-d")]
            ]
        ];
    }
}
