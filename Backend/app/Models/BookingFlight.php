<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFlight extends Model
{
    use HasFactory;


    protected $primaryKey = 'BookingID';

    protected $fillable = [
        'UserID',
        'FlightID',
        'Numberofpassengers',
        'ArrivalTime',
        'TotalPrice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'booking', 'BookingType', 'BookingID');
    }
}
