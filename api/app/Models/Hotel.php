<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'id',
        'name',
        'address',
        'city',
        'nit',
        'room_num'    
    ];
}
