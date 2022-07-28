<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'users';
    protected $guarded= [];

    
}