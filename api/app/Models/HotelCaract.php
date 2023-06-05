<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCaract extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'hotel_name',
        'type',
        'accommodation',
        'quantity'
    ];
}
