<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $primaryKey = 'ReviewID';

    protected $fillable = [
        'BookingID',     
        'BookingType',   
        'Rating',
        'ReviewText',
        'ReviewDate',
    ];

    public function booking()
    {
        return $this->morphTo(_FUNCTION_, 'BookingType', 'BookingID');
    }
}
