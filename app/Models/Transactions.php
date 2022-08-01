<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'txn_id',
        'fundraiser',
        'student',
        'amount_donated',
        'comission_amount',
        'amountWithoutComission',
        'payerName',
        'payerEmail',
        'currency',
        'description',
        'payment_method',
        'withdraw_status'
    ];
}
