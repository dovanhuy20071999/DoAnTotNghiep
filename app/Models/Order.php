<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'send_date',
        'received-date',
        'essay_id',
        'level_id',
        'deadline_id',
        'type_id',
        'total_price',
    ];
}
