<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_cars extends Model
{
    use HasFactory;

    protected $primaryKey = 'CarRentalID';

    protected $fillable = [
        'UserID',
        'CarModel',
        'SeatNumber',
        'Location',
        'PricePerDay',
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
        return $this->morphMany(Reviews::class, 'booking', 'BookingType', 'BookingID');
    }
}
