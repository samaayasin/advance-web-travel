<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingflight extends Model
{
    use HasFactory;


    protected $primaryKey = 'FlightID';

    protected $fillable = [
        'UserID',
        'AirlineName',
        'DepartureAirport',
        'ArrivalAirport',
        'DepartureTime',
        'ArrivalTime',
        'Price',
        'Availability',
        'StartDate',
        'EndDate',
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
