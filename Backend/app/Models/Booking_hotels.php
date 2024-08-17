<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_hotels extends Model
{
    use HasFactory;


    protected $primaryKey = 'HotelID';

    protected $fillable = [
        'UserID',
        'HotelName',
        'Location',
        'RoomType',
        'PricePerNight',
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
