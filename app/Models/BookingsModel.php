<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class BookingsModel extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'room_id',
        'start_time',
        'end_time',
        'status',
    ];
}
