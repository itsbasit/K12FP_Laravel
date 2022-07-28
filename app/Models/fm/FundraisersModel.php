<?php

namespace App\Models\fm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundraisersModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="fundraisers";
}
