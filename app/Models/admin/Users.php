<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded= [];

    
}