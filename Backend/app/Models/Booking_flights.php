<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_flights extends Model
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
        return $this->belongsTo(Users::class, 'UserID', 'UserID');
    }

    public function reviews()
    {
        return $this->morphMany(Reviews::class, 'booking', 'BookingType', 'BookingID');
    }
}
