<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmModel extends Model
{
    use HasFactory;
    protected $table="fund_manager";

    protected $fillable = [
        'position',
        'first_name',
        'last_name',
        'email',
        'password',
        'orgType',
        'org_name',
        'streetAddress',
        'orgState',
        'zipCode'
    ];

    
}
