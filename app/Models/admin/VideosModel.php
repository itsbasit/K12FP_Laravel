<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosModel extends Model
{
    use HasFactory;
    protected $table = 'demo_videos';
    protected $guarded= [];
}
